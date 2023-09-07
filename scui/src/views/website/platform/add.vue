<template>
	<el-dialog :title=title v-model="visible" :width="600" destroy-on-close>
		<el-form :model="form" :rules="rules" ref="dialogForm" label-width="100px"
				 label-position="left">
			<el-form-item label="名称" prop="name">
				<el-input v-model="form.name" clearable></el-input>
			</el-form-item>
			<el-form-item label="值" prop="value">
				<el-input v-model="form.value" clearable></el-input>
			</el-form-item>
			<el-form-item label="排序" prop="sort">
				<el-input-number v-model="form.sort" controls-position="right"
								 :min="0" style="width: 25%;"></el-input-number>
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
				sort: 255,
			},
			//验证规则
			rules: {
				name: [
					{required: true, message: '请输入'}
				],
				value: [
					{required: true, message: '请输入'}
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
					var res = await this.$API.website.platform.add.post(this.form);
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
