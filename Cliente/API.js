const endereco = document.querySelector('#logradouro');
const cep = document.querySelector('#cepcliente');
const cidade = document.querySelector('#cidade');  
const bairro = document.querySelector('#bairro');
const msg = document.querySelector('#msgerro');
const senha = document.querySelector('#senha');
const verifSenha = document.querySelector('#verifsenha');
const msgVerifSenha = document.querySelector('#msgverifsenha');
const uf = document.querySelector('#uf');  // Adicione a seleção do campo 'uf'

cep.addEventListener('focusout', async () => {
    try {
        const cepNumeros = cep.value.replace(/\D/g, '');
        const cepValido = /^\d{8}$/;

        if (!cepValido.test(cepNumeros)) {
            throw { cep_error: 'Digite um cep válido' };
        }
        
        const response = await fetch(`https://viacep.com.br/ws/${cepNumeros}/json/`);
        if (!response.ok) {
            throw { cep_error: 'Algo deu errado ao buscar o CEP' };
        }
        const responseCep = await response.json();

        // Verifique se a resposta contém os dados esperados
        if (responseCep.erro) {
            throw { cep_error: 'CEP não encontrado' };
        }

        endereco.value = responseCep.logradouro || '';
        bairro.value = responseCep.bairro || '';
        cidade.value = responseCep.localidade || '';
        uf.value = responseCep.uf || '';

        msg.textContent = ''; // Limpe a mensagem de erro se tudo estiver OK
    } catch (error) {
        if (error?.cep_error) {
            msg.textContent = error.cep_error;
        } else {
            console.error(error);
        }
    }
});

