<div id="orders">
    <button class="btn btn-success mb-4">Начать</button>
    <div class="row shadow-lg" style="height: 450px; overflow-y: auto; overflow-x: hidden">
       <ul>
           <li v-for="(item, index) in Orders">
               <div class="row justify-content-between border border-dark mt-4 mb-4" style="cursor: pointer"v-on:click="openModal(index)">
                   <div class="col-3 border-right border-dark">
                       <span  style="font-size: small"> {{item.time}} </span>
                   </div>
                   <div class="col-4 border-right border-dark">
                      <span style="font-size: small">{{item.address}}</span>
                   </div>
                   <div class="col">
                       {{item.summ}}
                   </div>
               </div>
           </li>
       </ul>
    </div>
    <div class="alert alert-info alert-dismissible fade show mt-4" role="alert" id="alert" style="display:none;">
        <div class="container">
            <div class="row text-center justify-content-end">
                <strong>{{ActiveElement.address}}</strong>
                <button type="button" class="btn-close" v-on:click="HideOrder" aria-label="Close"></button>

            </div>
            <div class="row">
                <ul>
                    <li v-for="item in ActiveElement.items">
                        {{item.name}}  {{item.amount}} * {{item.price}}р. = {{item.amount * item.price}} ₽
                    </li>

                </ul>
            </div>
        </div>
    </div>
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert" id="newOrder" style="display:none">

        <strong>Новый заказ!!!</strong>
        <button type="button" class="btn-close" v-on:click="CloseAlarma()" aria-label="Close"></button>
    </div>
</div>

<!-- Modal -->
