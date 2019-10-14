<!-- 最新版本的 Bootstrap 核心 CSS 文件 -->
<template>

    <div>
        <form action="http://www.laravelapi.com/imgUpdate" method="post" enctype="multipart/form-data">
            <table>
                <tr>
                    <td><img :src="data.member_img" alt=""></td>
                    <td>使用波奇头像：<br>上传本地图像</td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="file" name="img"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="保存"></td>
                </tr>
                <td><input type="hidden" v-model="id" name="id"></td>
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
                data:'',
                img:'',
                id:''
            }
        },

        created:function(){
            var _this = this
            // 为给定 ID 的 user 创建请求
            this.$axios.get('/api/userInfo')
                .then(function (response) {
                    console.log(response.data.data.member_id)
                    _this.data = response.data.data;
                    _this.id = response.data.data.member_id;
                })
                .catch(function (error) {
                    console.log(error);
                });
        },

    }

</script>