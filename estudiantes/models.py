from django.db import models
from django.contrib.auth.models import AbstractBaseUser, BaseUserManager, PermissionsMixin

class Persona(models.Model):
    cedula = models.CharField(max_length=50)
    nombre = models.CharField(max_length=100)
    correo = models.EmailField(null=True, blank=True)

    def __str__(self):
        return self.nombre

class Rol(models.Model):
    ADMINISTRADOR = 'Administrador'
    PROFESOR = 'Profesor'
    ROL_CHOICES = [
        (ADMINISTRADOR, 'Administrador'),
        (PROFESOR, 'Profesor'),
    ]

    nombre_rol = models.CharField(max_length=20, choices=ROL_CHOICES)

    def __str__(self):
        return self.nombre_rol

class PersonaRol(models.Model):
    persona = models.ForeignKey(Persona, on_delete=models.CASCADE)
    rol = models.ForeignKey(Rol, on_delete=models.CASCADE)

class UsuarioManager(BaseUserManager):
    def create_user(self, username, password=None, **extra_fields):
        if not username:
            raise ValueError('El nombre de usuario debe ser establecido')
        user = self.model(username=username, **extra_fields)
        user.set_password(password)
        user.save(using=self._db)
        return user

    def create_superuser(self, username, password=None, **extra_fields):
        extra_fields.setdefault('is_staff', True)
        extra_fields.setdefault('is_superuser', True)
        return self.create_user(username, password, **extra_fields)

class Usuario(AbstractBaseUser, PermissionsMixin):
    persona = models.OneToOneField(Persona, on_delete=models.CASCADE)
    username = models.CharField(max_length=100, unique=True)
    password = models.CharField(max_length=255)
    is_active = models.BooleanField(default=True)
    is_staff = models.BooleanField(default=False)
    groups = models.ManyToManyField(
        'auth.Group',
        related_name='custom_user_set',
        blank=True,
        help_text='The groups this user belongs to.',
        verbose_name='groups',
    )
    user_permissions = models.ManyToManyField(
        'auth.Permission',
        related_name='custom_user_set',
        blank=True,
        help_text='Specific permissions for this user.',
        verbose_name='user permissions',
    )

    objects = UsuarioManager()

    USERNAME_FIELD = 'username'

    def __str__(self):
        return self.username

class Curso(models.Model):
    nombre = models.CharField(max_length=100)
    descripcion = models.TextField(null=True, blank=True)

    def __str__(self):
        return self.nombre

class Estudiante(models.Model):
    persona = models.OneToOneField(Persona, on_delete=models.CASCADE)
    fecha_nacimiento = models.DateField()
    id_padre = models.ForeignKey('Padre', related_name='hijos', on_delete=models.CASCADE)
    id_curso = models.ForeignKey(Curso, on_delete=models.CASCADE)
    direccion = models.CharField(max_length=150)
    ciudad = models.CharField(max_length=100)

    def __str__(self):
        return self.persona.nombre


class Padre(models.Model):
    persona = models.OneToOneField(Persona, on_delete=models.CASCADE)
    direccion = models.CharField(max_length=150)
    ciudad = models.CharField(max_length=100)

    def __str__(self):
        return self.persona.nombre

class MensajeNoEnviado(models.Model):
    destinatario = models.CharField(max_length=100)
    correo = models.EmailField()
    titulo_mensaje = models.CharField(max_length=255)
    cuerpo_mensaje = models.TextField()
    documento_adjunto = models.CharField(max_length=255, null=True, blank=True)
    fecha_creacion = models.DateTimeField(auto_now_add=True)
    ESTADO_CHOICES = [
        ('pendiente', 'Pendiente'),
        ('enviado', 'Enviado'),
    ]
    estado = models.CharField(max_length=10, choices=ESTADO_CHOICES, default='pendiente')

class MensajeRecibido(models.Model):
    destinatario = models.ForeignKey(Persona, on_delete=models.CASCADE)
    titulo_mensaje = models.CharField(max_length=255)
    cuerpo_mensaje = models.TextField()
    fecha_recepcion = models.DateTimeField(auto_now_add=True)
    leido = models.BooleanField(default=False)

class Matricula(models.Model):
    estudiante = models.ForeignKey(Estudiante, on_delete=models.CASCADE)
    curso = models.ForeignKey(Curso, on_delete=models.CASCADE)
    fecha_matricula = models.DateTimeField(auto_now_add=True)

class Calificacion(models.Model):
    estudiante = models.ForeignKey(Estudiante, on_delete=models.CASCADE)
    curso = models.ForeignKey(Curso, on_delete=models.CASCADE)
    nota = models.DecimalField(max_digits=5, decimal_places=2)

class Documento(models.Model):
    nombre_documento = models.CharField(max_length=255)
    ruta_documento = models.CharField(max_length=255)
    fecha_subida = models.DateTimeField(auto_now_add=True)

class DocumentoEstudiante(models.Model):
    documento = models.ForeignKey(Documento, on_delete=models.CASCADE)
    estudiante = models.ForeignKey(Estudiante, on_delete=models.CASCADE)

class DocumentoProfesor(models.Model):
    documento = models.ForeignKey(Documento, on_delete=models.CASCADE)
    profesor = models.ForeignKey(Persona, on_delete=models.CASCADE)

class Anuncio(models.Model):
    titulo = models.CharField(max_length=255)
    contenido = models.TextField()
    fecha_publicacion = models.DateTimeField(auto_now_add=True)

class Evento(models.Model):
    nombre_evento = models.CharField(max_length=255)
    descripcion = models.TextField()
    fecha_evento = models.DateTimeField()
