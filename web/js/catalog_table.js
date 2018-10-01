(function(){
    window.addEventListener('click', function(e){
        if(e.target.className.indexOf('catalog-table__image') < 0) return;
        var src = e.target.dataset.bigimage;
        if(src === '') return;
        var wrapper = document.createElement('div');
        wrapper.className = 'image-modal__wrapper';
        var img = document.createElement('img');
        img.className = 'image-modal';
        var helper = document.createElement('span');
        helper.className = 'image-modal__wrapper-helper';
        wrapper.appendChild(img);
        wrapper.appendChild(helper);
        img.src = src;
        img.onload = function(e){
            document.body.appendChild(wrapper);
            wrapper.addEventListener('click', function(e){
                document.body.removeChild(wrapper);
            })
        }
    })
    window.addEventListener('input', function(e){
        if(e.target.className.indexOf('catalog__quantity-input') < 0) return;
        var input = e.target;
        if(input.value === "") return;
        var value = Number(input.value);
        var availableInput = input.parentElement.getElementsByClassName('catalog-table__available-input')[0];
        var available = Number(availableInput.value);
        if(isNaN(value)){
            input.value = input.dataset.oldvalue;
        }else if(value > available){
            input.value = available;
        }else if(value < 1){
            input.value = 1;
        }else{
            input.dataset.oldvalue = value;
        }
    })
    window.addEventListener('change', function(e){
        if(e.target.className.indexOf('catalog__quantity-input') < 0) return;
        if(e.target.value === "") e.target.value = e.target.dataset.oldvalue;
    })
    window.addEventListener('click', function(e){
        var className = e.target.className;
        if(className.indexOf('catalog-table__quantity-btn') > 0 || className.indexOf('catalog-table__quantity-btn-text' > 0)){
            target = e.target;
            if(className.indexOf('catalog-table__quantity-btn-text' > 0)){
                target = e.target.parentElement;
            }
            var quantity = target.parentElement.getElementsByClassName('catalog__quantity-input')[0].value;
            var id = target.dataset.id;
            var spiner = target.querySelector('#basketBtnSpiner');
            var text = target.querySelector('#basketBtnText');
            btn_catalog_add_to_basket(id, quantity, spiner, text);
        };


    })
    function btn_catalog_add_to_basket(id, q, spiner, text)
    {
        text.style.display = 'none';
        spiner.style.display = 'block';
        var xhttp = new XMLHttpRequest();
        var dataF = new FormData();
        dataF.append('elementid', id);
        dataF.append('quanty', q);
        xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            spiner.style.display = 'none';
            text.style.display = 'block';
            }
        };
        xhttp.open("POST", addToBasketUrl, true);
        xhttp.send(dataF);
    }
})()