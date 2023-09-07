<template>
	<el-dialog :title=title v-model="visible" :width="600" destroy-on-close>
		<el-form :model="form" :rules="rules" ref="dialogForm" label-width="100px"
				 label-position="left">
			<el-form-item label="标题" prop="title">
				<el-input v-model="form.title" clearable></el-input>
			</el-form-item>
			<el-form-item label="关键词" prop="keyword">
				<el-input v-model="form.keyword" clearable></el-input>
			</el-form-item>
			<el-form-item label="描述" prop="description">
				<el-input v-model="form.description" clearable></el-input>
			</el-form-item>
			<el-form-item label="位置" prop="position">
				<el-input v-model="form.position" clearable></el-input>
			</el-form-item>
			<el-form-item label="是否显示" prop="is_show">
				<el-radio-group v-model="form.is_show" class="ml-4">
					<el-radio :label="10" size="large">是</el-radio>
					<el-radio :label="20" size="large">否</el-radio>
				</el-radio-group>
			</el-form-item>
			<el-form-item label="所属平台" prop="platform">
				<el-cascader v-model="form.platform" :options="platform.list" :props="platform.props"
							 :show-all-levels="false" clearable style="width: 50%;"></el-cascader>
			</el-form-item>
			<el-form-item label="语言类型" prop="lang">
				<el-cascader v-model="form.lang" :options="lang.list" :props="lang.props"
							 :show-all-levels="false" clearable style="width: 50%;"></el-cascader>
			</el-form-item>
			<el-form-item label="排序" prop="sort">
				<el-input-number v-model="form.sort" controls-position="right"
								 :min="0" style="width: 30%;"></el-input-number>
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
			platform: {
				list: [],
				checked: [],
				props: {
					value: "value",
					emitPath: false,
					checkStrictly: true,
					label: "name"
				}
			},
			lang: {
				list: [],
				checked: [],
				props: {
					value: "value",
					emitPath: false,
					checkStrictly: true,
					label: "name"
				}
			},
			title: '增加',
			visible: false,
			//表单数据
			form: {
				name: "",
				sort: 255,
				is_show: 10
			},
			//验证规则
			rules: {
				title: [
					{required: true, message: '请输入'}
				],
				keyword: [
					{required: true, message: '请输入'}
				],
				description: [
					{required: true, message: '请输入'}
				],
				position: [
					{required: true, message: '请输入'}
				],
				platform: [
					{required: true, message: '请输入'}
				],
				lang: [
					{required: true, message: '请输入'}
				]
			}
		}
	},
	mounted() {
		this.getLang()
		this.getPlatform()
	},
	methods: {
		async getLang() {
			var res = await this.$API.website.lang.list.get()
			if (res.code == 200) {

				this.lang.list = res.data.list
			} else {
				this.$alert(res.msg, "提示", {type: 'error'})
			}
		},
		async getPlatform() {
			var res = await this.$API.website.platform.list.get()
			if (res.code == 200) {
				this.platform.list = res.data.list
			} else {
				this.$alert(res.msg, "提示", {type: 'error'})
			}
		},
		//显示
		open() {
			this.visible = true;
			return this
		},
		//表单提交方法
		submit() {
			this.$refs.dialogForm.validate(async (valid) => {
				if (valid) {
					var res = await this.$API.website.seo.add.post(this.form);
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
