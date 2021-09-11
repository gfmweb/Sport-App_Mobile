
var Orders = new Vue({
   el:'#orders',
   data:{

      Orders:{},
      ActiveElement:{

      }
   },
   methods:{
      openModal : function(element){
            this.ActiveElement = this.Orders[element]
         var alert = document.getElementById('alert')
         alert.style='display:block'
      },
      HideOrder: function(){
         var alert = document.getElementById('alert')
         alert.style='display:none'
      },
      CheckUpdate: function(){
         const self = this
         axios.get('/Lk/getOrders').then(res => {
            self.Orders = res.data.content
            if(res.data.status == 'NEW'){
               self.Alarma()
            }
         });

      },
      Alarma: function(){
         var order = document.getElementById('newOrder')
         order.style='display:block'
         var BackSound = new Audio('content/sounds/alarm.mp3');
         BackSound.play();

      },
      CloseAlarma: function(){
         var order = document.getElementById('newOrder')
         order.style='display:none'

      },
      wa: function(){
         setInterval(this.CheckUpdate,1000)

      }
   },
   mounted: function(){
      this.CheckUpdate();
      this.wa();
   }
});