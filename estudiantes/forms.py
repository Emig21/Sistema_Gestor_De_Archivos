from django import forms
from .models import *

class FormularioEstudiante(forms.ModelForm):
    class Meta:
        model = Estudiante
        fields = ['persona', 'fecha_nacimiento', 'id_curso', 'id_padre', 'direccion', 'ciudad']
        widgets = {
            'persona': forms.Select(attrs={'class': 'form-control'}),
            'fecha_nacimiento': forms.DateInput(attrs={'class': 'form-control', 'type': 'date'}),
            'id_curso': forms.Select(attrs={'class': 'form-control'}),
            'id_padre': forms.Select(attrs={'class': 'form-control'}),
            'direccion': forms.TextInput(attrs={'class': 'form-control'}),
            'ciudad': forms.TextInput(attrs={'class': 'form-control'}),
        }

   


class FormularioCurso(forms.ModelForm):
    class Meta:
        model = Curso
        fields = ['nombre', 'descripcion']
        widgets = {
            'nombre': forms.TextInput(attrs={'class': 'form-control'}),
            'descripcion': forms.Textarea(attrs={'class': 'form-control'}),
        }

class FormularioPersona(forms.ModelForm):
    class Meta:
        model = Persona
        fields = ['cedula', 'nombre', 'correo']
        widgets = {
            'cedula': forms.TextInput(attrs={'class': 'form-control'}),
            'nombre': forms.TextInput(attrs={'class': 'form-control'}),
            'correo': forms.EmailInput(attrs={'class': 'form-control'}),
        }

class FormularioUsuario(forms.ModelForm):
    class Meta:
        model = Usuario
        fields = ['username', 'password']
        widgets = {
            'username': forms.TextInput(attrs={'class': 'form-control'}),
            'password': forms.PasswordInput(attrs={'class': 'form-control'}),
        }

class FormularioRol(forms.ModelForm):
    class Meta:
        model = Rol
        fields = ['nombre_rol']
        widgets = {
            'nombre_rol': forms.Select(attrs={'class': 'form-control'}),
        }

class FormularioPadre(forms.ModelForm):
    
    
    class Meta:
        model = Padre
        fields = ['persona', 'direccion', 'ciudad']
        widgets = {
            'persona': forms.Select(attrs={'class': 'form-control'}),
            'direccion': forms.TextInput(attrs={'class': 'form-control'}),
            'ciudad': forms.TextInput(attrs={'class': 'form-control'}),
        }

