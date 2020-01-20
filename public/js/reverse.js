document.querySelectorAll("renverse").forEach(function (link) {
    link.onclick = function(){
        document.body.style['transition'] = 'transform 3s';
        document.body.style['transform'] = 'rotate(180deg)'
    }
});