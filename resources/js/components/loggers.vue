<template>
    <div class="container">
        <div class="row justify-content-md-center">
            <div class="col-md-5">
                <h1>Dagen idag.</h1>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-md-5">
                
                <div id="border">
                    <div v-if="logs.length > 0">
                        <div v-for="(logger, index) in logs" :key="logger.id">
                            <div v-if="logger.type == 0">
                                <h3>
                                    {{logger.question}} 
                                    <button @click="destroy(index)" type="button" class="close" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button> 
                                </h3>
                                <div class="row">
                                    <div class="col-md-6 padding-0" >
                                        <button class="btn" type="button" @click="answerYes(index)" id="btnone">JA</button>
                                    </div> 
                                    <div class="col-md-6 padding-0">
                                        <button class="btn" type="button" @click="answerNo(index)" id="btntwo">NEJ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                             <p></p>
                        </div>
                                <div class="row justify-content-md-center">
                                    <div class="col-md-6">
                                        <button class="btn" id="btnsubmit" @click="dailySubmit()">
                                            OK
                                        </button>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

</template>

<script>
export default {
    data(){
        return {
            logs:[{'question':'loader..', 'type':'0', 'value':'0'}],
            errors:[]
        }
    },

    created: function(none){
        this.loadLogs();
    },

    methods: {
        answerYes: function(index){
            this.logs[index].value = 1;
            console.log(this.logs[index].value + " " +  index)
        },
        answerNo: function(index){
            this.logs[index].value = -1;
            console.log(this.logs[index].value + " " +  index)
        },

        loadLogs: function() {
            axios.get('/logger/public/loggers/')
            .then((response) => {
                this.logs = response.data;
            }).catch((error => {

            }))
        },

        dailySubmit: function() {
            var alerts = false;
            this.logs.forEach(log => {
                if(log.value == 0){
                    alerts = true;
                }
            });

            if (alerts){
                alert("Udfyld alle felter.");
            } else {
                axios.post('/logger/public/loggers/log', {
                    logs: this.logs
                }).then((response) => {
                    console.log(response.data.message)
                }).catch(error => {

                })
            }


        },

        destroy: function(index){
            let conf = confirm("Du er ved at fjerne en logger permanent!");
            if(conf==true){
                axios.delete('/logger/public/loggers/' + this.logs[index].id)
                .then(response => {
                    this.logs.splice(index, 1);
                })
                .catch(error => {
                    console.log(error);
                })
            }
            
        }
    }


}
</script>

<style>
h3{
    padding: 10px 0px 0px 10px;
    color: white;
}

#border{
    border: 10px;
    border-style:solid;
    border-radius: 5px;
    border-color:#141414;
    background-color:#141414
}

#btnone{
    font-weight: bold;
    border-radius: 0px;
    background-color: #19a829;
    width: 100%;
}
#btntwo{
    font-weight: bold;
    border-radius: 0px;
    background-color:brown;
    width: 100%;
}

#btnsubmit{
    font-weight: bold;
    border-radius: 3px;
    background-color:#19a829;
    width: 100%;
}

.padding-0{
    padding-right:0;
    padding-left:0;
}

</style>
