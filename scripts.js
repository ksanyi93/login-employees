import {paginatelinks, trow} from './html_content.js';

$(function(){
    getData('id', '', from)
})

$('#th_name').click(function(){
    getData('name')
})

$('#th_dept').click(function(){
    getData('department')
})

$('#th_class').click(function(){
    getData('class')
})

$('#th_date').click(function(){
    getData('date')
}) 

$('#btn_search').click(function(){
    if($('#search').val().trim().length > 0){
        getData('id', $('#search').val().trim(), 0)
    }
})

function  deleteEmplyee( id ) {
    $.post('api.php', {
        delete: id
    }, function(data, status){
        getData('id', '', from)
    })
}

function getData(orderby = 'id', kw = '', from = 0){

    $('#top').fadeIn()
    
    $.get('api.php?from='+from+'&ob='+orderby+'&kw='+kw, function(data, status){

        const obj = JSON.parse(data)

        const result = obj.result.map(function(row){
            return trow(orderby, row);
        })
        
        $('tbody').html(result)
   
        $('#paginate').html( paginatelinks(
            Math.ceil(obj.record_number/20), from
        ))

        $('#select_paginate').change(function(){
            window.location='index.php?from='+(this.value*20)
        }) 

        $("button[data-id]").click(function(){
           
            deleteEmplyee( $(this).data('id'))
        })

        //console.log(obj.record_number/20)
        $('#top').fadeOut()
    });
}