<template>
    <div>
        <form @submit.prevent="submit">
            <div class="row my-3">
                <div class="col-lg-12 col-xl-12">
                    <label class="h6 ">ユーザーネーム</label>
                </div>
                <div class="col-lg-12 col-xl-12">

                    <input class="form-control" type="text" id="userName" name="name" v-model="name">

                </div>
            </div>
            <div class="row my-3">
                <div class="col-lg-12 col-xl-12">
                    <label class="h6">アイコン(5MB未満)</label>
                </div>
                <div class="col-lg-12 col-xl-12 custom-file">
                    <div class="custom-file">

                        <input @change="handleFileChange" type="file"  class="form-control" name="icon" accept=".png, .jpeg, .jpg, .gif, .tiff, .ico">

                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-end">
                <div class="col-lg-6 col-xl-6 d-flex justify-content-end">
                    <input class="btn btn-secondary" type="submit" name="btn" value="変更">
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            iconFile:null,
            name:"",
            visible:true,
            erros:null,
        };
    },
    methods: {
        handleFileChange(event) {
            this.iconFile = event.target.files[0];
            console.log('file');
        },
        submit() {
            let formData = new FormData();
            if (this.iconFile) {
                formData.append('user_icon', this.iconFile);
                console.log('add icon');
            } 
            if(this.name){
                formData.append('user_name', this.name);
                console.log('add name');
            }

            axios.post("/updateAccount",formData)
            .then(function (response) {
                window.location.href = response.data.redirectTo;
                
            })
            console.log('post request');
        },
    },
};
</script>
