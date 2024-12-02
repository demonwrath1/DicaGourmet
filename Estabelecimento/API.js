const endereco = document.querySelector('#logradouro');
const cep = document.querySelector('#cepestab');
const cidade = document.querySelector('#cidade');  
const bairro = document.querySelector('#bairro');
const msg = document.querySelector('#msgerro');
const senha = document.querySelector('#senha');
const verifSenha = document.querySelector('#VerifSenha');
const msgVerifSenha = document.querySelector('#msgverifsenha');

    cep.addEventListener('focusout', async() => {

    try {
        const cepNumeros = cep.value.replace(/\D/g, '');
     
        const cepValido = /^\d{8}$/;

        if(!cepValido.test(cepNumeros)) {
    
             throw { cep_error: 'Digite um cep válido'};
            
        }
        
        const response = await fetch(`https://viacep.com.br/ws/${cep.value}/json/`);
        if( !response.ok) {
            throw { cep_error : 'algo deu errado'};
        }
        const responseCep = await response.json();

        endereco.value = responseCep.logradouro;
        bairro.value = responseCep.bairro;
        cidade.value = responseCep.localidade;
        uf.value = responseCep.uf;
        
    }
    catch (error) {
        if (error?.cep_error) {
            msg.textContent = error.cep_error;
        }
        console.log(error);
    }
})

