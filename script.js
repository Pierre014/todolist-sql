(()=>{
    //fonction drag and drop take on sortable js
    function sortable(rootEl, onUpdate){
        var dragEl, nextEl;
        
        [].slice.call(rootEl.children).forEach(function (itemEl){
            itemEl.draggable = true;
        });
        
        function _onDragOver(evt){
            evt.preventDefault();
            evt.dataTransfer.dropEffect = 'move';
            var target = evt.target;
            if( target && target !== dragEl && target.nodeName == 'LI' ){
                var rect = target.getBoundingClientRect();
                var next = (evt.clientY - rect.top)/(rect.bottom - rect.top) > .5;
                rootEl.insertBefore(dragEl, next && target.nextSibling || target);
            }
        }
        
        function _onDragEnd(evt){
            evt.preventDefault();
            dragEl.classList.remove('ghost');
            rootEl.removeEventListener('dragover', _onDragOver, false);
            rootEl.removeEventListener('dragend', _onDragEnd, false);
        
            if( nextEl !== dragEl.nextSibling ){
                
                onUpdate(dragEl);
            }
        }
        
        
        rootEl.addEventListener('dragstart', function (evt){
            dragEl = evt.target;
            nextEl = dragEl.nextSibling;
            evt.dataTransfer.effectAllowed = 'move';
            evt.dataTransfer.setData('Text', dragEl.textContent);
        
            
            rootEl.addEventListener('dragover', _onDragOver, false);
            rootEl.addEventListener('dragend', _onDragEnd, false);
        
            setTimeout(function (){
                
                dragEl.classList.add('ghost');
            }, 0)
        }, false);
        }
        
        sortable( document.getElementById('list'), function (item){});
    
        //fetch
        

})()