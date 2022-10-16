# avaliacao-planium

Implementado uma API e consumo da propria pela interface da pagina

### Desemvolvimento

- Ferramentas utilizadas: VisualStudioCode, Github Desktop, XAMP, Postman

Para consultar os dados da api, realize um GET via HTTP para: http://localhost/avaliacao-planium/api/v1

1 - Realizar um POST via HTTP para o seguinte endereço: http://localhost/avaliacao-planium/api/v1/dados_proposta, como no exemplo abaixo:
```json
{
    "plano": "reg1",
    "beneficiarios": [
        {
            "nome": "Luiza",
            "idade": "17"
        },
        {
            "nome": "Rick",
            "idade": "18"
        }
    ]
}
```
2 - Obtera a seguinte saida
```json
{
    "registro": "reg1",
    "quantidade": 2,
    "beneficiarios": [
        {
            "nome": "Luiza",
            "idade": "17",
            "preco": 10
        },
        {
            "nome": "Rick",
            "idade": "18",
            "preco": 12
        }
    ],
    "total": 22
}
```
