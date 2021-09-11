var LoginRegModal = new Vue({
   el:'#LoginRegModal',
   data:{
       FormVariables:{

       },
       STEPS:{},
       ActiveStep:'',
       Title:'Регистрация',
       ModalWindow  :   new bootstrap.Modal(document.getElementById('LoginRegModalbootstrap'))
   },
   mounted: function(){

   },
   methods:{
       OpenModal: function(act){
           if(act == 'Registration'){
               this.Title = 'Регистрация';
           }
           else{
               this.Title = 'Вход';
           }
           this.ModalWindow.show()
           this.Pushki()
       },
       Pushki: function(){
           if (!('serviceWorker' in navigator)) {
               // Браузер не поддерживает сервис-воркеры.
               console.log('No workers in Navigator')
               return
           }
           if (!('PushManager' in window)) {
               // Браузер не поддерживает push-уведомления.
               console.log('No Push MANAGER')
               return
           }
           if ('serviceWorker' in navigator) {
               console.log('Try to register')
               window.addEventListener('load', function() {
                   navigator.serviceWorker.register('/wpworker.js').then(function(registration) {
                       // Успешная регистрация
                       console.log('ServiceWorker registration successful');
                   }, function(err) {
                       // При регистрации произошла ошибка
                       console.log('ServiceWorker registration failed: ', err);
                   });
               });
           }
       },
       GeoCoords: function(){

       }
   }
});