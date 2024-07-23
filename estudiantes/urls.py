from django.urls import path
from . import views

urlpatterns = [
    path('', views.index, name='principal'),
    path('login/', views.login_view, name='login'),
    path('principal/', views.principal, name='principal'),
    path('estudiantes', views.ver_estudiantes, name='estudiantes'),
    path('estudiantes/crear/', views.ingresar_estudiante, name='crear_estudiante'),
    path('estudiantes/<int:pk>/editar/', views.editar_estudiante, name='editar_estudiante'),
    path('estudiantes/<int:pk>/eliminar/', views.eliminar_estudiante, name='eliminar_estudiante'),
    path('estudiantes/crearcurso/', views.ingresar_curso, name='crear_curso'),
    path('estudiantes/crearpersona/', views.ingresar_persona, name='crear_persona'),
    path('profesores/crearprofesor/', views.ingresar_profesor, name='crear_profesor'),
    path('padres/crearpadre/', views.ingresar_padre, name='crear_padre'),
    path('usuarios', views.crear_usuarios, name='usuarios'),
    path('usuarios/<int:pk>/eliminar/', views.eliminar_usuario, name='eliminar_usuario'),
]
