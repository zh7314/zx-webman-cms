<template>
	<!--	<el-alert-->
	<!--		title="异步组件动态加载使用了正处于试验阶段的<Suspense>组件, 其API和使用方式可能会改变. <Suspense> is an experimental feature and its API will likely change."-->
	<!--		type="warning" show-icon style="margin-bottom: 15px;"/>-->

	<el-card shadow="never" header="个人信息">
		<el-form ref="form" :model="form" :rules="rules" label-width="120px" style="margin-top:20px;">
			<el-form-item label="账号">
				<el-input v-model="form.name" disabled></el-input>
				<div class="el-form-item-msg">账号信息用于登录，系统不允许修改</div>
			</el-form-item>
			<el-form-item label="姓名">
				<el-input v-model="form.real_name"></el-input>
			</el-form-item>
			<el-form-item label="性别">
				<el-select v-model="form.sex" placeholder="请选择">
					<el-option label="保密" value="10"></el-option>
					<el-option label="男" value="20"></el-option>
					<el-option label="女" value="30"></el-option>
				</el-select>
			</el-form-item>
			<!--			<el-form-item label="个性签名">-->
			<!--				<el-input v-model="form.about" type="textarea"></el-input>-->
			<!--			</el-form-item>-->
			<el-form-item>
				<el-button type="primary" :loading="isSaveing" @click="save">保存</el-button>
			</el-form-item>
		</el-form>
	</el-card>
</template>

<script>
export default {
	mounted() {
		this.getUserInfo()
	},
	emits: ['success', 'closed'],
	data() {
		return {
			isSaveing: false,
			form: {
				name: "administrator@scuiadmin.com",
				real_name: "Sakuya",
				sex: "0",
				about: "正所谓富贵险中求"
			},
			rules: {
				name: [
					{required: true, message: '请输入真实姓名'}
				],
				sex: [
					{required: true, message: '请输入性别'}
				]
			}
		}
	},
	methods: {
		async getUserInfo() {
			var userInfo = this.$TOOL.data.get("USER_INFO")
			this.user = userInfo ?? {}

			var res = await this.$API.system.admin.getOne.post({id: userInfo.userId})
			// console.log(res)
			if (res.code == 200) {
				Object.assign(this.form, res.data)
				this.form.sex = res.data.sex.toString()
				//防止重置密码
				this.form.password = null
			} else {
				this.$alert(res.msg, "提示", {type: 'error'})
			}

		},
		async save() {
			this.$refs.form.validate(async valid => {
				if (valid) {
					this.isSaveing = true;
					var res = await this.$API.system.admin.save.post(this.form);
					this.isSaveing = false;
					if (res.code == 200) {
						this.$message.success("操作成功")
					} else {
						console.log(11111122222)
						this.$alert(res.msg, "提示", {type: 'error'})
					}
				} else {
					return false
				}
			})
		}
	}
}
</script>

<style>
</style>
