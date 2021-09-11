var NavbarVUE = new Vue({
   el:'#Navbar',
   data:{
       SearchQuery  :   '',
       SearchResults:   [],
       NoErrors     :   true,
       TooShort     :   false,
       NoResults    :   false,
   },
   methods:{
       QuerySTR: function(){
           const self = this
           axios.get('/SearchResult/Navbar?query='+this.SearchQuery).then(res => {
               if (res.data.status =='success'){
                   self.SearchResults = res.data.data
                   self.OpenMod()
               }// Результат ответа от сервера
               if(res.data.status =='nothing to show'){
                    self.NoErrors  = false
                    self.NoResults = true
               }
               if(res.data.status =='too short'){
                   self.NoErrors  = false
                   self.TooShort  = true

               }
           });
       },
       OpenMod:function(){

          SearchModal.UpdateContent(this.SearchResults)
       },
       ClearAlert: function (alerts){
          if(alerts =='Tooshort'){
              this.TooShort = false
              this.NoErrors = true
          }
           if(alerts =='NoResults'){
               this.NoResults = false
               this.NoErrors = true
           }
       }
   }
});

var SearchModal = new Vue({
    el: '#ResBlock',
    data:{
        SearchResultsContent:[],
        ModalWindow  :   new bootstrap.Modal(document.getElementById('NavbarSearchResults')),
        TRT:'654',
        helloM:'jjj'
    },
    methods: {
        UpdateContent:function(data){
            this.SearchResultsContent = data
            this.ModalWindow.show();
        }
    }
});