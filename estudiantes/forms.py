from django import forms
from django.contrib.auth.forms import AuthenticationForm
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
    contraseña = forms.CharField(widget=forms.PasswordInput(attrs={'class': 'form-control'}), label='Contraseña')
    confirm_contraseña = forms.CharField(widget=forms.PasswordInput(attrs={'class': 'form-control'}), label='Confirmar contraseña')
    es_superusuario = forms.BooleanField(required=False, widget=forms.CheckboxInput(attrs={'class': 'form-check-input'}), label='Es superusuario')
    es_activo = forms.BooleanField(required=False, initial=True, widget=forms.CheckboxInput(attrs={'class': 'form-check-input'}), label='Está activo')
    es_personal = forms.BooleanField(required=False, widget=forms.CheckboxInput(attrs={'class': 'form-check-input'}), label='Es personal')

    class Meta:
        model = Usuario
        fields = ['username', 'contraseña', 'confirm_contraseña', 'es_superusuario', 'es_activo', 'es_personal']
        labels = {
            'username': 'Nombre de usuario',
        }
        widgets = {
            'username': forms.TextInput(attrs={'class': 'form-control'}),
            'contraseña': forms.PasswordInput(attrs={'class': 'form-control'}),
            'confirm_contraseña': forms.PasswordInput(attrs={'class': 'form-control'}),
            'es_superusuario': forms.CheckboxInput(attrs={'class': 'form-check-input'}),
            'es_activo': forms.CheckboxInput(attrs={'class': 'form-check-input'}),
            'es_personal': forms.CheckboxInput(attrs={'class': 'form-check-input'}),
        }

    def clean(self):
        cleaned_data = super().clean()
        contraseña = cleaned_data.get("contraseña")
        confirm_contraseña = cleaned_data.get("confirm_contraseña")

        if contraseña != confirm_contraseña:
            raise forms.ValidationError("Las contraseñas no coinciden")

        return cleaned_data

class FormularioRol(forms.ModelForm):
    class Meta:
        model = Rol
        fields = ['nombre_rol']
        widgets = {
            'nombre_rol': forms.TextInput(attrs={'class': 'form-control'}),
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

class FormularioLogin(AuthenticationForm):
    username = forms.CharField(
        widget=forms.TextInput(attrs={'class': 'form-control', 'placeholder': 'Ingrese su usuario'})
    )
    password = forms.CharField(
        widget=forms.PasswordInput(attrs={'class': 'form-control', 'placeholder': 'Contraseña'})
    )
