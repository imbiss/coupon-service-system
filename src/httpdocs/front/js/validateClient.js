"use strict";
(function (c) {

    /**
     * The client class defined start
     */
    var d = new function() {

        this.init = function(){

            if (csTerminalInfo) {
                alert(csTerminalInfo);
                alert(csTerminalInfo.terminalUuid);
            } else {
                alert("Can not get terminal infor");
            }



            var c = document.getElementById('couponServiceContainer');

            var inputField = document.createElement('input');
            var attrType = document.createAttribute('type');
            attrType.nodeValue="text";
            inputField.setAttributeNode(attrType);


        };


    };
    // client class defined end


    d.init();

})();