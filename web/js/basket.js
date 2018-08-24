(function(w){
    w.addEventListener('click', function(e){
        var link = e.target;
        if(link.className.indexOf('basket__quantity-link') < 0) return;
        var parent = link.parentElement;
        var input = parent.getElementsByTagName('input')[0];
        var newValue = Number(input.value);
        if(isNaN(newValue)){
            input.value = input.dataset.oldvalue;
            return;
        }
        link.href = link.href.replace(/q=\d/, 'q='+newValue)
    })
    window.addEventListener('click', function(e){
        if(e.target.className.indexOf('basket-product-image') < 0) return;
        var url = e.target.dataset.big;
        if(url == '') return;
        var wrapper = document.createElement('div');
        wrapper.className = 'image-modal__wrapper';
        var wrapperHelper = document.createElement('span');
        wrapperHelper.className = 'image-modal__wrapper-helper';
        var img = document.createElement('img');
        img.className = 'image-modal';
        wrapper.appendChild(wrapperHelper);
        wrapper.appendChild(img);
        img.onload = function(){
            document.body.appendChild(wrapper);
            wrapper.onclick = function(){
                document.body.removeChild(wrapper);
            }
        } 
        img.src = url;
    })
})(window)