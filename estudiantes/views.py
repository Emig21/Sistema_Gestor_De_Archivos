from django.contrib.auth import authenticate, login
from django.contrib import messages
from django.http import HttpResponseRedirect, JsonResponse
from django.urls import reverse
from django.shortcuts import render
from django.shortcuts import redirect, render, get_object_or_404
from .models import *
from .forms import *

def ver_estudiantes(request):
    estudiantes = Estudiante.objects.all()
    return render(request, "estudiantes/estudiantes.html", {'estudiantes': estudiantes})

def ver_usuarios(request):
    usuarios = Usuario.objects.all()
    return render(request, "control/usuarios.html", {'usuarios': usuarios})

def principal(request):
    principal = Estudiante.objects.all()
    return render(request, "control/principal.html", {'principal': principal})

def index(request):
    return redirect('login')

def ingresar_estudiante(request):
    if request.method == "POST":
        formulario = FormularioEstudiante(request.POST)
        if formulario.is_valid():
            estudiante = formulario.save(commit=False)
            persona_seleccionada = formulario.cleaned_data['persona']
            # Asegurarse de que solo hay una persona seleccionada
            if Persona.objects.filter(id=persona_seleccionada.id).count() == 1:
                estudiante.persona = persona_seleccionada
                estudiante.id_padre = formulario.cleaned_data['id_padre']
                estudiante.save()
                return redirect('estudiantes')
            else:
                # Manejar el caso donde hay múltiples objetos retornados
                formulario.add_error('persona', 'La selección de persona no es única.')
        else:
            print(formulario.errors)  # Esto ayudará a depurar cualquier problema con la validación del formulario
    else:
        formulario = FormularioEstudiante()
    return render(request, 'estudiantes/crear_estudiante.html', {'formulario': formulario})

def editar_estudiante(request, pk):
    estudiante = get_object_or_404(Estudiante, pk=pk)
    if request.method == 'POST':
        formulario = FormularioEstudiante(request.POST, instance=estudiante)
        if formulario.is_valid():
            estudiante = formulario.save()
            return redirect('estudiantes')
    else:
        formulario = FormularioEstudiante(instance=estudiante)
    return render(request, 'estudiantes/crear_estudiante.html', {'formulario': formulario}) 

def eliminar_estudiante(request, pk):
    estudiante = get_object_or_404(Estudiante, pk=pk)
    estudiante.delete()
    return redirect('estudiantes')

def ingresar_curso(request):
    if request.method == "POST":
        formulario = FormularioCurso(request.POST)
        if formulario.is_valid():
            formulario.save()
            return redirect('estudiantes')
    else:
        formulario = FormularioCurso()
    return render(request, 'estudiantes/crear_curso.html', {'form': formulario})

def ingresar_persona(request):
    if request.method == "POST":
        formulario = FormularioPersona(request.POST)
        if formulario.is_valid():
            formulario.save()
            return redirect('estudiantes')
    else:
        formulario = FormularioPersona()
    return render(request, 'estudiantes/crear_persona.html', {'form': formulario})

def ingresar_profesor(request):
    if request.method == "POST":
        formulario_persona = FormularioPersona(request.POST)
        if formulario_persona.is_valid():
            persona = formulario_persona.save()
            rol_profesor, created = Rol.objects.get_or_create(nombre_rol='Profesor')
            PersonaRol.objects.create(persona=persona, rol=rol_profesor)
            return redirect('estudiantes')
    else:
        formulario_persona = FormularioPersona()
    return render(request, 'profesores/crear_profesor.html', {'form_persona': formulario_persona})

def ingresar_padre(request):
    if request.method == "POST":
        formulario_padre = FormularioPadre(request.POST)
        if formulario_padre.is_valid():
            padre = formulario_padre.save()
            rol_padre, created = Rol.objects.get_or_create(nombre_rol='Padre de familia')
            PersonaRol.objects.create(persona=padre.persona, rol=rol_padre)
            return redirect('estudiantes')
    else:
        formulario_padre = FormularioPadre()
    return render(request, 'padres/crear_padre.html', {'form_padre': formulario_padre})

def crear_usuarios(request):
    if request.method == 'POST':
        formulario = FormularioUsuario(request.POST)
        if formulario.is_valid():
            usuario = formulario.save(commit=False)
            usuario.set_password(formulario.cleaned_data['contraseña'])
            usuario.is_active = formulario.cleaned_data.get('es_activo', True)
            usuario.is_staff = formulario.cleaned_data.get('es_personal', False)
            usuario.is_superuser = formulario.cleaned_data.get('es_superusuario', False)
            usuario.save()
            return JsonResponse({'success': True})
        else:
            return JsonResponse({'success': False, 'errors': formulario.errors})
    else:
        usuarios = Usuario.objects.all()
        formulario = FormularioUsuario()
        return render(request, 'control/usuarios.html', {'usuarios': usuarios, 'formulario': formulario})

def eliminar_usuario(request, pk):
    usuario = get_object_or_404(Usuario, pk=pk)
    usuario.delete()
    return redirect('usuarios')

def login_view(request):
    if request.method == 'POST':
        form = FormularioLogin(request, data=request.POST)
        if form.is_valid():
            username = form.cleaned_data.get('username')
            password = form.cleaned_data.get('password')
            user = authenticate(request, username=username, password=password)
            if user is not None:
                login(request, user)
                messages.success(request, 'Inicio de sesión exitoso.')
                return HttpResponseRedirect(reverse('principal'))
            else:
                form.add_error(None, 'Por favor, ingrese un nombre de usuario y contraseña correctos. Ambos campos pueden ser sensibles a mayúsculas y minúsculas.')
                messages.error(request, 'Nombre de usuario o contraseña incorrectos.')
    else:
        form = FormularioLogin()
    return render(request, 'control/login.html', {'form': form})