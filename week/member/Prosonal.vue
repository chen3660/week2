<template>

    <div>
        <form>
            <table>
                <tr>
                    <td>昵称：</td>
                    <td><input type="text" placeholder="请输入昵称" v-model="nickname"></td>
                </tr>
                <tr>
                    <td>职业</td>
                    <td><input type="text" v-model="career" placeholder="请输入职业"></td>
                </tr>
                <tr>
                    <td>QQ</td>
                    <td><input type="text" v-model="QQ" placeholder="请输入QQ号"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button @click="register">提交</button></td>
                </tr>
            </table>
        </form>
    </div>

</template>

<script>
    export default {
        name: 'HelloWorld',
        data () {
            return {
                data:{
                    //phone:this.$route.phone,
                    career:'',
                    nickname:'',
                    QQ:'',
                }
            }
        },
        methods:{
            register:function () {
                var _this = this;
                var career = this.career;
                var nickname = this.nickname;
                var QQ = this.QQ;
                //alert(member_phone);
                this.$axios.post('/api/userBasics', {
                    career: career,
                    nickname: nickname,
                    QQ: QQ,
                })
                    .then(function (response) {
                        alert(response.data.msg);
                        if (response.data.code==0){
                            _this.$router.push('Updateimg');
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }
        }
    }
</script>