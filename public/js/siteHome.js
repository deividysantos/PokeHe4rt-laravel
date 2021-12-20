let htmlDespesa=
    '<form class="despesaAlert" action="/MoneyManagment/back/despesaPost.php" method="POST"> ' +
    '<label>R$</label>' +
    '<input type="number" name="despesa" id="despesa"><br>' +
    '<label>Categoria</label>' +
    '<input type="numbers" name="categoria" id="categoria"><br> '+
    '<label>Descição</label>' +
    '<textarea name="descricao" id="descricao" rows="4" cols="15"></textarea><br>' +
    '<input type="submit" value="Cadastrar"></form> ';

let htmlRenda=
    '<form class="rendaAlert" action="/MoneyManagment/back/rendaPost.php" method="POST"> ' +
    '<label>R$</label>' +
    '<input type="number" name="valor" id="valor"><br>' +
    '<label>Categoria</label>' +
    '<input type="text" name="origem" id="origem"><br> '+
    '<input type="submit" value="Cadastrar"></form> ';

function getDespesa(){
    Swal.fire({
        title: 'Nova Despesa',
        html: htmlDespesa,

        showConfirmButton: false
    })
}

function getRenda(){
    Swal.fire({
        title: 'Nova Renda',
        html: htmlRenda,

        showConfirmButton: false
    })
}

function showDetails(descricao){
    Swal.fire({
        title: 'Descrição',
        html:descricao,

        showConfirmButton: false
    })
}
