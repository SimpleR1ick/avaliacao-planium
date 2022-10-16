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

    let div = document.querySelector('#forms');

    let input_div = document.createElement('div');
    input_div.className = 'row mb-3'; 

    // Criando nova div
    let nome_div = document.createElement('div');
    nome_div.className = 'col-sm-6';

    let idade_div = document.createElement('div');
    idade_div.className = 'col-sm-6';

    // Criando input nome
    const nome = document.createElement('input');
    nome.className = 'form-control';
    nome.setAttribute('required', '');
    nome.name = `nome${i}`;
    nome.type = 'text';

    // Criando label nome
    const label_nome = document.createElement('label');
    label_nome.className = 'form-label';
    label_nome.setAttribute('for', nome.id);
    label_nome.innerHTML = 'Nome';

    // Criando input idade
    const idade = document.createElement('input');
    idade.className = 'form-control';
    idade.setAttribute('required', '');
    idade.name = `idade${i}`;
    idade.type = 'number';
    idade.min = 0;

    // Criando label idade
    const label_idade = document.createElement('label');
    label_idade.className = 'form-label';
    label_idade.setAttribute('for', idade.id);
    label_idade.innerHTML = 'Idade';

    // Colocando os 
    nome_div.appendChild(label_nome)
    nome_div.appendChild(nome);
    idade_div.appendChild(label_idade)
    idade_div.appendChild(idade);

    input_div.appendChild(nome_div);
    input_div.appendChild(idade_div);

    div.appendChild(input_div);
}