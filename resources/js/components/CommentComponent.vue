<template>
    <div class="container-fluid " id="vueCom" style="height:100%; width: 100%; position: relative; padding:0;">
        <div id="board">
            <div class="row">
                <div class="container" id="commentContainer">
                    <div class="comments">
                        <ul class="" style="list-style-type: none">
                            <div v-for="item in list_com" class="border border-secondary-subtle flex-grow-0">
                                <p>
                                    {{ item }}
                                </p>
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-comment " style="width:100%; position: absolute; bottom: 0;" id="commentForm">
            <div class="row border border px-3">
                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="col d-flex">
                        <input class="textInput" id="text" style="width:80%;" placeholder="コメントする" v-model="comment">
                        <button class="btn btn-outline-secondary" style="flex-grow:1;" @click="addComment(comment)">送信</button>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
import Echo from 'laravel-echo'
export default {
    props: ['videoId','iconPublic'],
    data() {
        return {
        list_com: [],
        comment: "",
        };
    },
    methods: {
        addComment() {
            let formData = new FormData();
            formData.append('comment', this.comment);
            formData.append('video_id', this.videoId);
            this.comment = "";
            axios.post("/insertComment",formData)
        },
        getComment(){
            let formData = new FormData();
            formData.append('video_id', this.videoId);
            axios.post('/getComment',formData).then((response) => {
                //console.log(response.data);
                response.data.video_data.forEach(element => {
                    //console.log(element);
                    this.list_com.push(element.text);
                });

            });
        }
    },
    mounted(){
        const sourceElement = document.getElementById('vueCom');
        const sourceHeight = sourceElement.clientHeight;
        const targetElement = document.getElementById('commentContainer');
        const form = document.getElementById('commentForm');
        targetElement.style.maxHeight = sourceHeight - form.clientHeight + 'px';

        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: process.env.MIX_PUSHER_APP_KEY,
            cluster: process.env.MIX_PUSHER_APP_CLUSTER,
            encrypted: true,
        });

        window.Echo.channel('comments').listen('CommentSend', (event) => {
            console.log('New comment:', event.comment);
            this.list_com.push(event.comment);
        });
        this.getComment();

    }
};
</script>
