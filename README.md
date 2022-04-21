## Auth - login
```sh
POST /auth
{
"usuario" :"", -> REQUERIDO
"password": "" -> REQUERIDO
}
```
## pacientes
```sh
GET /pacientes?page=$numeroPagina
GET /pacientes?id=$idPaciente
```

```sh
POST /pacientes
{
"nombre" : "", -> REQUERIDO
"dni" : "", -> REQUERIDO
"correo":"", -> REQUERIDO
"codigoPostal" :"",
"genero" : "",
"telefono" : "",
"fechaNacimiento" : "",
"token" : "" -> REQUERIDO
}
```
```sh
PUT /pacientes
{
"nombre" : "",
"dni" : "",
"correo":"",
"codigoPostal" :"",
"genero" : "",
"telefono" : "",
"fechaNacimiento" : "",
"token" : "" , -> REQUERIDO
"pacienteId" : "" -> REQUERIDO
}
```
```sh
DELETE /pacientes
{
"token" : "", -> REQUERIDO
"pacienteId" : "" -> REQUERIDO
}
```
