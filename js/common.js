$(window).load(function(){
    $("pre").addClass("prettyprint linenums");
    prettyPrint();
});

var del = function(id,link) {
    console.log(link,id);
    if(confirm('Are you sure you want to delete this item?')) {
        $.ajax({
            url : link+'/'+id,
            type: 'POST',
            // data: {id: id},
            dataType: 'json',
            success : function(response){
                if( response.status == 0){
                    location.href = "../index";
                } else {
                    alert(response.message);
                }
                return false;
            },
            error: function(){
                alert('Bad request!');
                return false;
            }
        });
    } else {
        return false;
    }
} 
