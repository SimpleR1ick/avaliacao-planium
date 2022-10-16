// Pega o valor do input e é chamado sempre que o valor muda
function alterarQtdPessoas(){
    let div = document.querySelector('#forms');
    div.innerHTML = '';

    var pessoas = document.getElementById('qtdpessoas').value;

    for (let i = 1; i <= pessoas; i++) {
        criarForms(i);
    }
}

function criarForms(i){
    // Criando nova div
    let novaDiv = document.createElement('div');
    let div = document.querySelector('#forms');

    // Criando input nome
    const nome = document.createElement('input');
    nome.name = `nome${i}`;
    nome.type = 'text';
    
    // Criando label nome
    const labelNome = document.createElement('label');
    labelNome.setAttribute('for', nome.id);
    labelNome.innerHTML = 'Nome: ';

    // Criando input idade
    const idade = document.createElement('input');
    idade.name = `idade${i}`;
    idade.type = 'number';
    idade.min = 0;

    // Criando label idade
    const labelIdade = document.createElement('label');
    labelIdade.setAttribute('for', idade.id);
    labelIdade.innerHTML = 'Idade: ';

    // Colocando os inputs na div
    novaDiv.appendChild(labelNome)
    novaDiv.appendChild(nome);
    novaDiv.appendChild(labelIdade)
    novaDiv.appendChild(idade);

    div.appendChild(novaDiv);
}