from django.shortcuts import redirect, render, get_object_or_404
from .models import *
from .forms import *

def index(request):
    estudiantes = Estudiante.objects.all()
    return render(request, "estudiantes/estudiantes.html", {'estudiantes': estudiantes})
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
        formulario = FormularioEstudiante(request.POST, instance = estudiante)
        if formulario.is_valid():
            estudiante = formulario.save()
            return redirect('estudiantes')
    else:
        formulario = FormularioEstudiante(instance = estudiante)
    return render(request, 'estudiantes/crear_estudiante.html', {'formulario': formulario}) 

def eliminar_estudiante(request, pk):
    estudiante = get_object_or_404(Estudiante, pk=pk)
    if request.method == 'POST':
        estudiante.delete()
        return redirect('estudiantes')

    return render(request, 'estudiantes/eliminar_estudiante.html', {'formulario': estudiante, 'show_modal':True}) 


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
        formulario_usuario = FormularioUsuario(request.POST)
        if formulario_persona.is_valid() and formulario_usuario.is_valid():
            persona = formulario_persona.save()
            rol_profesor, created = Rol.objects.get_or_create(nombre_rol='Profesor')
            PersonaRol.objects.create(persona=persona, rol=rol_profesor)
            usuario = formulario_usuario.save(commit=False)
            usuario.persona = persona
            usuario.save()
            return redirect('estudiantes')
    else:
        formulario_persona = FormularioPersona()
        formulario_usuario = FormularioUsuario()
    return render(request, 'profesores/crear_profesor.html', {'form_persona': formulario_persona, 'form_usuario': formulario_usuario})

def ingresar_padre(request):
    if request.method == "POST":
        formulario_padre = FormularioPadre(request.POST)
        if formulario_padre.is_valid():
           
            formulario_padre.save()
            rol_padre, created = Rol.objects.get_or_create(nombre_rol='Padre de familia')
            PersonaRol.objects.create(persona=formulario_padre.persona, rol=rol_padre)
            return redirect('estudiantes')
    else:
        formulario_padre = FormularioPadre()
    return render(request, 'padres/crear_padre.html', {'form_padre': formulario_padre})
