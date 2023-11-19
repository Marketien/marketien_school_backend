<template>
    <form @submit.prevent="submit()">
        <div class="form-group row">
            <div class="col-md-6">
                <label>Name</label>
                <input readonly type="text" class="form-control" v-model="name" />
            </div>
            <div class="col-md-6">
                <label>Registration Number</label>
                <input readonly type="text" class="form-control" v-model="regNo" />
            </div>
        </div>
        <div class="form-group row">
            <div class="col-md-6">
                <label>Class</label>
                <input readonly type="text" class="form-control" v-model="class" />
            </div>
            <div class="col-md-6">
                <label>Father Name</label>
                <input readonly type="text" class="form-control" v-model="fatherName" />
            </div>
        </div>
       <div class="form-group row">
        <div class="col-md-6">
            <label>Select Month:</label><br>
        <select class="form-select" v-model="month" multiple @change="getAmount()" >
            <option value="january">January</option>
            <option value="february">February</option>
            <option value="march">March</option>
            <option value="april">April</option>
            <option value="may">May</option>
            <option value="june">June</option>
            <option value="july">July</option>
            <option value="august">August</option>
            <option value="september">September</option>
            <option value="october">October</option>
            <option value="november">November</option>
            <option value="december">December</option>
        </select><br>
        <h3>{{month.length}}</h3>
        </div>
        <div class="col-md-6">
            <label>Amount</label>
            <input type="text" class="form-control" v-model="amount"   >
        </div>

       <br>
       </div>
       <div class="form-group row">
        <div class="col-md-6">
            <label>Transaction Id</label>
            <input type="text" class="form-control" v-model="transactionId"   >
        </div>
        <div class="col-md-6">
            <label>Payment Status</label>
            <input  type="text" class="form-control" v-model="paymentStatus"   >
        </div>
       </div>
        <div class="form-group row">
            <label class="col-md-4 col-form-label"></label>
            <div class="col-md-8">
                <input type="submit" class="btn btn-success"  value="Submit" />
            </div>
        </div>

    </form>
</template>
<script type="module">
import axios from 'axios';
import VueAxios from 'vue-axios';
export default {
    props:['student'],
    data() {
        return {
            errors:[],
            month:[],
            amount:'',
            name:'',
            regNo:'',
            class:'',
            transactionId:'',
            paymentStatus:'',
            fatherName:'',
            id:'',
            
        }
    },
    methods: {
        getStudent(){
            axios.get('api/get-student-name').then((response)=>{
                this.name = response.data.name;
                this.regNo = response.data.regNo;
                this.class = response.data.class;
                this.fatherName = response.data.fatherName;
                this.id = response.data.id;
            });
            console.log(this.name);
            // console.log(this.month[]);
        },
        getAmount(){
            var initial = this.amount;
            var middle = 0;
            var amt;
            this.amt = this.month.length;
            if(this.amt > 1){
                if((this.amount/(this.amt+1)) === this.initial){
                    // this.middle = this.amount/(this.amt+1);
                // this.amount = this.amount - (this.middle * this.amt);
                this.amount = this.initial * this.amt;
            }
            else{
               this.amount = (this.amount/(this.amt - 1)) * this.amt;
                
            }
              
                }
            
            else{
                if((this.amount/(this.amt+1)) === this.initial){
                    this.middle = this.amount/(this.amt+1);
                this.amount = this.amount - (this.middle * this.amt);
                }
                else{
                    if((this.amount/(this.amt+1)) > this.initial){
                        this.amount = this.initial * this.amt;
                    }
                    else{
                        this.amount = this.amt * this.amount;
                    }
                    
                }
                
            }
            this.initial = this.amount/this.amt;
            this.paymentStatus = 1;
            
            
            // if((this.amount/this.amt) != this.initial){
            //     this.amount = this.amount - (this.initial* this.amt);
            // }
            
            },
            submit:function(e){
                axios.post('/api/store-payment',{
                    id: this.id,
                    name: this.name,
                    regNo: this.regNo,
                    class: this.class,
                    month:this.month,
                    amount:this.amount,
                    transactionId:this.transactionId,
                    payment_status:this.paymentStatus
                }).then((response)=>{
                  this.id = response.data;
                  window.location.href = ('/student-detail');
                });

            }
        
        
    },
    mounted() {
        this.getStudent();
        this.getAmount();
    }
}
</script>

















           
           
