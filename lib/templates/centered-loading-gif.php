<div>
  <template id="LoadingBlock">
    <div id="iam-loading" >
      <div>
        <img src="/image/FlatPreloaders/32x32/Preloader_1/Preloader_1.gif">
      </div>
      <style>
        #iam-loading {
          position: relative; 
          width: 100%;
          height: 50px;
        }
        #iam-loading div {
          display: block;
          position: absolute;
          top: 50%;
          left: 50%;
          margin-right: -50%;
          -webkit-transform: translate(-50%,-50%);
          -ms-transform: translate(-50%,-50%);
          transform: translate(-50%,-50%);
        }
      </style>
    </div>
  </template>
  <script type="text/javascript">
      var IamLoading = (function(){

        //stamp out template
        var IamLoadingDiv = $(document.getElementById("LoadingBlock").content.cloneNode(true));
        return {
          show: function(jQueryParent){
            IamLoadingDiv.after(jQueryParent); //jQueryParent.children().first().after(IamLoadingDiv);
          },
          remove: function(jQueryParent){
            jQueryParent.find("div#iam-loading").remove();
          } 
        }
      })();
  </script>
</div>