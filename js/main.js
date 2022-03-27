function filtroModaIntima(){

    $('.produtos-box').css('display', 'none');

    if($('#conjuntos').is(':checked')){
      $('.conjuntos').css('display' , 'block');   
    }

    if($('#sutias').is(':checked')){
      $('.sutias').css('display' , 'block');   
    }

    if($('#calcinhas').is(':checked')){
      $('.calcinhas').css('display' , 'block');   
    }

    if($('#body').is(':checked')){
      $('.body').css('display' , 'block');   
    }

    if($('#camisolas').is(':checked')){
      $('.camisolas').css('display' , 'block');   
    }

    if($('#pijamas').is(':checked')){
      $('.pijamas').css('display' , 'block');   
    }

    if($('#biquinis').is(':checked')){
      $('.biquinis').css('display' , 'block');   
    }

    /*Condição para todos voltarem a aparecer quando
    nenhuma caixa estiver marcada*/
    if($('#conjuntos').is(':not(:checked)') && $('#sutias').is(':not(:checked)') 
      && $('#calcinhas').is(':not(:checked)') && $('#camisolas').is(':not(:checked)')
      && $('#pijamas').is(':not(:checked)') && $('#body').is(':not(:checked)') && $('#biquinis').is(':not(:checked)')){
      $('.produtos-box').css('display', 'block');
    }

}

function filtroSemijoias(){

    $('.produtos-box').css('display', 'none');

    if($('#brincos').is(':checked')){
      $('.brincos').css('display' , 'block');   
    }

    if($('#pulseiras').is(':checked')){
      $('.pulseiras').css('display' , 'block');   
    }

    if($('#aneis').is(':checked')){
      $('.anéis').css('display' , 'block');   
    }

    if($('#pingentes').is(':checked')){
      $('.pingentes').css('display' , 'block');   
    }

    if($('#colares').is(':checked')){
      $('.colares').css('display' , 'block');   
    }

    /*Condição para todos voltarem a aparecer quando
    nenhuma caixa estiver marcada*/
    if($('#brincos').is(':not(:checked)') && $('#pulseiras').is(':not(:checked)') 
      && $('#aneis').is(':not(:checked)') && $('#pingentes').is(':not(:checked)')
      && $('#colares').is(':not(:checked)')){
      $('.produtos-box').css('display', 'block');
    }

}


