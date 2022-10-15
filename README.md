# avaliacao-planium

Ainda não consegui estabelecer a interface para o consumo da api, mas realizei todos os testes utilizando um aplicativo de API, como no meu caso o Postman

1 - Realizar um post via HTTP para o seguinte endereço: http://localhost/avaliacao-planium/api/v1/dados_proposta
    Entrada via raw no seguinte formato:
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
