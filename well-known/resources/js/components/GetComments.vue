<template>

            <div class="comment-one__content" >
<!--                {{comments}}-->

                <div v-for="comment in comments">
                    <span class="c_name">{{ comment.user.name }}</span>
                    <span>Commented:</span>
                    <div class="comment">{{ comment.comment }}.</div>
                </div>
<!--                <div v-for="comment in comments">

                    <h3>{{ comment.user.name }} <span>Commented:</span></h3>
                    <p>{{ comment.comment }}</p>
                </div>-->


            </div>

<!--    <div class="avatar">-->
<!--        <img src="images/avatar-light.jpg" alt="" /></div>-->
<!--    <div class="comment-info">-->
<!--        <div v-for="comment in comments">-->
<!--        <span class="c_name">{{ comment.user.name }}</span>-->
<!--        <span class="c_date id-color">8 August 2018</span>-->
<!--        <span class="c_reply"><a href="#">Reply</a></span>-->

<!--        <div class="clearfix"></div>-->
<!--    </div>-->
<!--    <div class="comment">{{ comment.comment }}.</div>-->
<!--    </div>-->

</template>

<script>
export default {
    props:['userid', 'blogid'],
    data(){
        return {
            comments:[]
        }
    },
    mounted() {
       this.getComments()
    },
    methods:{
        getComments(){
            console.log("test mounted")
            // let liveBaseUrl = "http/domain.com/blogs"
            let baseUrl = "http://127.0.0.1:8000/api/"
            axios.get(baseUrl+'getComments/' + this.blogid).then((response)=> {
                this.comments = response.data.comments
                // console.log(response.data.comments)
            }).catch((errors)=>{
                console.log(errors)
            });
        }
    }
}
</script>
