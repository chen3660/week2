<!-- 完成用户注册
    并跳转到登录页面
 -->
<template>

    <div>
        <form>
            <table>
                <tr>
                    <td>手机号码：</td>
                    <td><input type="text" placeholder="请输入手机号码" v-model="phone"></td>
                </tr>
                <tr>
                    <td>用户名：</td>
                    <td><input type="text" v-model="name"></td>
                </tr>
                <tr>
                    <td>设置密码：</td>
                    <td><input type="password" v-model="pwd"></td>
                </tr>
                <tr>
                    <td>确认密码：</td>
                    <td><input type="password" v-model="qpwd" placeholder="请再次输入密码"></td>
                </tr>
                <tr>
                    <td>昵称：</td>
                    <td><input type="text" v-model="nickname" placeholder="请输入昵称"></td>
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
    export default {
        name: 'HelloWorld',
        data () {
            return {
                data:{
                    name:'',
                    phone:'',
                    pwd:'',
                    qpwd:'',
                    nickname:'',
                }
            }
        },
        methods:{
            register:function () {
                var _this = this;
                var name = this.name;//接值
                var member_phone = this.phone;//接值
                var pwd = this.pwd;//接值
                var qpwd = this.qpwd;//接值
                var nickname = this.nickname;//接值
                //alert(member_phone);
                this.$axios.post('/api/userRegiter', {//以post方式发送
                    name: name,
                    member_phone: member_phone,
                    pwd: pwd,
                    qpwd: qpwd,
                    nickname: nickname,
                })
                    .then(function (response) {//成功返回结果
                        alert(response.data.msg);
                        if (response.data.code==0){
                            _this.$router.push('Login');//跳转
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

            }
        }
    }
</script>