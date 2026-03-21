<template>
    <div class="row">
        <div class="col-xl-12">
            <textarea name="comment" v-model="formData.comment" placeholder="Your message here" rows="3" cols="100"></textarea>
        </div>
        <button type="submit" class="thm-btn comment-form__btn" @click="comment1Store">submit comment</button>
    </div>

</template>

<script>
    export default {
       props: ['userid', 'blogid'],
        data() {
           return {
               formData:{
                   comment:'',
                   user_id: this.userid,
                   blog_id: this.blogid,

               }
           }
        },
        methods: {
           comment1Store(){
               // let liveBaseUrl = "http/domain.com/blogs"
               let baseUrl = "http://127.0.0.1:8000/api/"
               axios.post(baseUrl+'comment/store', this.formData).then((response)=> {
               console.log(response.data)
           }).catch((errors) =>{
                   console.log(errors)
        });
           }
        }
    }
</script>
