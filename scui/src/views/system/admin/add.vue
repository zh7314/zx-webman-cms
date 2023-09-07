<template>
	<el-dialog :title=title v-model="visible" :width="500" destroy-on-close>
		<el-form :model="form" :rules="rules" ref="dialogForm" label-width="100px"
				 label-position="left">
			<el-form-item label="头像" prop="avatar">
<!--				<sc-upload v-model="form.avatar" title="上传头像"></sc-upload>-->
				<sc-upload v-model="form.avatar" title="上传头像" :cropper="true" :compress="1" :aspectRatio="1/1" round></sc-upload>
			</el-form-item>
			<el-form-item label="用户名" prop="name">
				<el-input v-model="form.name" clearable></el-input>
			</el-form-item>
			<el-form-item label="密码" prop="password">
				<el-input v-model="form.password" type="password" clearable></el-input>
			</el-form-item>
			<el-form-item label="真实姓名" prop="real_name">
				<el-input v-model="form.real_name" clearable></el-input>
			</el-form-item>
			<el-form-item label="超级管理员" prop="is_admin">
				<el-radio-group v-model="form.is_admin" class="ml-4">
					<el-radio label="10" size="large">是</el-radio>
					<el-radio label="99" size="large">否</el-radio>
				</el-radio-group>
			</el-form-item>
			<el-form-item label="是否登录" prop="status">
				<el-switch v-model="form.status" active-value="10" inactive-value="20"></el-switch>
			</el-form-item>
			<el-form-item label="性别" prop="sex">
				<el-radio-group v-model="form.sex" class="ml-4">
					<el-radio label="10" size="large">保密</el-radio>
					<el-radio label="20" size="large">男</el-radio>
					<el-radio label="30" size="large">女</el-radio>
				</el-radio-group>
			</el-form-item>
			<el-form-item label="手机号" prop="mobile">
				<el-input v-model="form.mobile" clearable></el-input>
			</el-form-item>
			<el-form-item label="email" prop="email">
				<el-input v-model="form.email" clearable></el-input>
			</el-form-item>
			<el-form-item label="排序" prop="sort">
				<el-input-number v-model="form.sort" controls-position="right"
								 :min="0" style="width: 40%;"></el-input-number>
			</el-form-item>
		</el-form>
		<template #footer>
			<el-button @click="visible=false">取 消</el-button>
			<el-button type="primary" @click="submit()">保 存</el-button>
		</template>
	</el-dialog>
</template>

<script>
export default {
	data() {
		return {
			title: '增加',
			visible: false,
			//表单数据
			form: {
				name: "",
				password: "",
				sort: 1,
				status: "10",
				sex: "10",
				is_admin: "99",
			},
			//验证规则
			rules: {
				name: [
					{required: true, message: '请输入登录名'}
				],
				password: [
					{required: true, message: '请输入角色别名'}
				],
				real_name: [
					{required: true, message: '请输入真实姓名'}
				]
			}
		}
	},
	mounted() {

	},
	methods: {
		//显示
		open() {
			this.visible = true;
			return this
		},
		//表单提交方法
		submit() {
			this.$refs.dialogForm.validate(async (valid) => {
				if (valid) {
					var res = await this.$API.system.admin.add.post(this.form);
					if (res.code == 200) {
						this.$emit('success', this.form, this.mode)
						this.visible = false;
						this.$message.success("操作成功")
					} else {
						this.$alert(res.msg, "提示", {type: 'error'})
					}
				}
			})
		}
	}
}
</script>

<style>
</style>
