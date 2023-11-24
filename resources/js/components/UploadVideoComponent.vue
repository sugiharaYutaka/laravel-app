<template>
    <div>
        <form @submit.prevent="submit">
            <div class="row my-3">
                <div class="col-lg-12 col-xl-12">
                    <label class="h6 ">動画(100MB未満)</label>
                </div>
                <div class="col-lg-12 col-xl-12 custom-file">
                    <div class="custom-file">

                        <input @change="getVideo" type="file"  class="form-control" name="Video" accept=".mp4" required>

                    </div>
                    <p v-if="videoError" class="text-danger">{{ videoError }}</p>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-lg-12 col-xl-12">
                    <label class="h6">サムネイル(5MB未満)</label>
                </div>
                <div class="col-lg-12 col-xl-12 custom-file">
                    <div class="custom-file">

                        <input @change="getThumbnail" type="file"  class="form-control" name="Thumbnail" accept=".png, .jpeg, .jpg, .gif, .tiff">

                    </div>
                    <p v-if="thumbnailError" class="text-danger">{{ thumbnailError }}</p>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-lg-12 col-xl-12">
                    <label class="h6">タイトル</label>
                </div>
                <div class="col-lg-12 col-xl-12 custom-file">
                    <div class="custom-file">

                        <input  type="text"  class="form-control" name="title" v-model="title" required>

                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-end">
                <div class="col-lg-6 col-xl-6 d-flex justify-content-end">
                    <input class="btn btn-secondary" type="submit" name="btn" value="投稿">
                </div>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            videoFile:null,
            thumbnailFile:null,
            title:"",
            visible:true,
            erros:null,
            videoSize:null,
            thumbnailSize:null,
            videoMaxSize:100000000,//ほぼ100MB
            thumbnailMaxSize:5000000,//ほぼ5MB
            thumbnailError:"",
            videoError:"",

        };
    },
    methods: {
        getVideo(event) {
            this.videoFile= event.target.files[0];
            this.videoSize = this.videoFile.size
            console.log(this.videoSize);
            console.log('video file');
            if(this.videoSize > this.videoMaxSize)
            {
                this.videoError = "100MB未満のファイルを選択してください";
            }
            else
            {
                this.videoError = "";
            }
        },
        getThumbnail(event) {
            this.thumbnailFile = event.target.files[0];
            this.thumbnailSize = this.thumbnailFile.size;
            console.log(this.thumbnailSize);
            console.log('thumb file');
            if(this.thumbnailSize > this.thumbnailMaxSize)
            {
                this.thumbnailError = "5MB未満のファイルを選択してください";
            }
            else
            {
                this.thumbnailError = "";
            }
        },
        submit() {
            if(this.thumbnailSize < this.thumbnailMaxSize && this.videoSize < this.videoMaxSize)
            {
                let formData = new FormData();
                if (this.videoFile) {
                    formData.append('video', this.videoFile);
                    console.log('add video');
                }
                if(this.thumbnailFile){
                    formData.append('thumbnail', this.thumbnailFile);
                    console.log('add thumbnail');
                }
                if(this.title != ""){
                    formData.append('title', this.title);
                    console.log('add title');
                }

                axios.post("/uploadVideo",formData)
                .then(function (response) {
                    window.location.href = response.data.redirectTo;
                    console.log('post request');

                })
                .catch(function (error) {
                    console.error('post request failed', error);
                });
            }
        },
    },
};
</script>
