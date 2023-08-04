$(".counter-plus").click(function (e){
    let qte = $(e.currentTarget).siblings("#qte")

    if (qte.val()>=99){
        alert("la qte doit etre entre 1 et 99")
        qte.val(99)
    }else {
        let qteValue = parseInt(qte.val())+1
        qte.val(qteValue)
    }
})
$(".counter-minus").click(function (e){
    let qte = $(e.currentTarget).siblings("#qte")
    
    if (qte.val()<=0){
        alert("la qte doit etre entre 1 et 99")
        qte.val(1)
    }else {
        let qteValue = parseInt(qte.val())-1
        qte.val(qteValue)
    }
})
