import psycopg2
#NOS CONECTAMOS MEDIANTE PSYCOPG2
conexion = psycopg2.connect(host="localhost", database="info", user="postgres", password="carljr107")
cur = conexion.cursor()

#PEDIMOS DATOS
nombre = input('Ingrese el nombre: ')
apellido = input('Ingrese apellido: ')
correo = input('Ingrese correo electrónico: ')

#CREAMOS LA CONSULTA A LA BD
query= "insert into estudiantes(e_nombre, e_apellido, e_correo) values('"+nombre+"','"+apellido+"','"+correo+"');"

#EJECUTAMOS LA CONSULTA
cur.execute(query)

#MOSTRAMOS TODOS LOS REGISTROS
cur.execute("SELECT e_nombre, e_apellido, e_correo FROM estudiantes;")
i=1
for nombre, apellido, correo in cur.fetchall():
    print(i, nombre, apellido, correo)
    i+=1

#CERRAMOS CONEXION
conexion.close()