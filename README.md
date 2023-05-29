Campanha utilizando landing page

Teremos três arquivos:  
1 - Página de divulgação do produto/serviço;  
2 - Página de agradecimento;  
3 - Página de consulta dos cadastros realizados.  

```sql
CREATE DATABASE campanha;

USE campanha;

CREATE TABLE cadastro (
    codigo INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL,
    whatsapp VARCHAR(20) NULL, 
    PRIMARY KEY (codigo)
    ); 
```
