<!-- 完成用户登录
    并跳转到个人信息页面 -->
<template>

    <div>
        <form>
            <table>
                <tr>
                    <td><input type="text" placeholder="请输入账号" v-model="phone"></td>
                </tr>
                <tr>
                    <td><input type="password" v-model="pwd" placeholder="密码"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><button @click="register">注册</button></td>
                </tr>
            </table>
        </form>
    </div>

</template>

<script>
    import Prosonal from "./Prosonal";

    export default {
        name: 'HelloWorld',
        data () {
            return {
                data:{
                    phone:'',
                    pwd:'',
                }
            }
        },
        methods:{
            register:function () {
                var _this = this;
                var member_phone = this.phone;//接值
                var pwd = this.pwd;
                //alert(member_phone);
                this.$axios.post('/api/userLogin', {//以post方式发送
                    member_phone: member_phone,
                    pwd: pwd,
                })
                    .then(function (response) {//成功后返回结果
                        alert(response.data.msg);
                        if (response.data.code==0){
                            _this.$router.push({//跳转并传值
                                name:'Prosonal',
                                params:{
                                    phone:member_phone
                                }
                            });
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }
        }
    }
</script>