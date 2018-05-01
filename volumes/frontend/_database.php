<?php 
 
/* Informações para conexão com o banco de Dados */
 
$_host = "nrdr_db";             /* host ex: localhost, 127.0.0.1 e etc.  */
$_user = "nrdr";                  /* usuário para conexão com o banco  */
$_pass = "nrdrsenha";                /* senha para conexão com o banco  */
$_database = "nrdr3";  /* nome do banco de dados */
 
 
 
/* Trabalhando com o define - não precisa configurar */
 
define("DATABASE_HOST", $_host);
define("DATABASE_USER", base64_encode($_user));
define("DATABASE_PASS", base64_encode($_pass));
define("DATABASE_NAME", $_database);
 
unset($_host);
unset($_user);
unset($_pass);
unset($_database);
