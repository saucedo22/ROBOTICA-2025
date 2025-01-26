from flask import Flask, render_template, request, redirect, flash, url_for
from flask_mail import Mail, Message
import random
import string

app = Flask(_name_)
app.secret_key = "clave_secreta"  # Para manejar mensajes flash

# Configuración de Flask-Mail
app.config['MAIL_SERVER'] = 'smtp.gmail.com'
app.config['MAIL_PORT'] = 587
app.config['MAIL_USE_TLS'] = True
app.config['MAIL_USERNAME'] = 'tu_correo@gmail.com'  # Cambia esto
app.config['MAIL_PASSWORD'] = 'tu_contraseña_de_app'  # Usa contraseña de app
mail = Mail(app)

# Base de datos simulada
usuarios = {
    "usuario1@gmail.com": {"contraseña": "123456", "codigo": None}
}

# Ruta para la página principal (Inicio de sesión)
@app.route('/')
def index():
    return render_template('login.html')

# Ruta para manejar "Olvidaste tu contraseña"
@app.route('/olvide_contraseña', methods=['POST'])
def olvide_contraseña():
    correo = request.form['correo']
    if correo in usuarios:
        # Generar un código aleatorio de 6 caracteres
        codigo = ''.join(random.choices(string.ascii_letters + string.digits, k=6))
        usuarios[correo]['codigo'] = codigo

        # Enviar el código al correo
        msg = Message("Recuperación de Contraseña",
                      sender='tu_correo@gmail.com',
                      recipients=[correo])
        msg.body = f"Tu código de verificación es: {codigo}"
        mail.send(msg)

        flash("Código enviado a tu correo.", "success")
        return redirect(url_for('verificar_codigo', correo=correo))
    else:
        flash("Correo no registrado.", "danger")
        return redirect(url_for('index'))

# Ruta para verificar el código y cambiar contraseña
@app.route('/verificar/<correo>', methods=['GET', 'POST'])
def verificar_codigo(correo):
    if request.method == 'POST':
        codigo_ingresado = request.form['codigo']
        nueva_contraseña = request.form['nueva_contraseña']

        # Verificar el código
        if usuarios[correo]['codigo'] == codigo_ingresado:
            # Actualizar la contraseña y eliminar el código
            usuarios[correo]['contraseña'] = nueva_contraseña
            usuarios[correo]['codigo'] = None
            flash("Contraseña actualizada exitosamente.", "success")
            return redirect(url_for('index'))
        else:
            flash("Código incorrecto.", "danger")

    return render_template('verificar.html', correo=correo)

if _name_ == '_main_':
    app.run(debug=True)