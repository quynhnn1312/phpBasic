    function decQuantity(event) {
        let input = event.target.parentElement.parentElement.querySelector('input');
        let valueInput = +input.value;
        if(valueInput > 1){
            input.value = valueInput - 1;
        }
    }
    function incQuantity(event) {
        let input = event.target.parentElement.parentElement.querySelector('input');
        let valueInput = +input.value;
        input.value = valueInput + 1;
    }