<template>
	<el-dialog :title=title v-model="visible" :width="800" destroy-on-close>
		<el-form :model="form" :rules="rules" ref="dialogForm" label-width="100px"
				 label-position="left">
			<el-form-item label="姓名" prop="real_name">
				<el-input v-model="form.real_name" clearable></el-input>
			</el-form-item>
			<el-form-item label="联系方式" prop="mobile">
				<el-input v-model="form.mobile" clearable></el-input>
			</el-form-item>
			<el-form-item label="邮件" prop="email">
				<el-input v-model="form.email" clearable></el-input>
			</el-form-item>
			<el-form-item label="标题" prop="title">
				<el-input v-model="form.title" clearable></el-input>
			</el-form-item>
			<el-form-item label="反馈内容" prop="content">
				<el-input v-model="form.content" :rows="5"
						  type="textarea" clearable></el-input>
			</el-form-item>
			<el-form-item label="图片集" prop="pics">
				<sc-upload-multiple v-model="form.pics" draggable :limit="5"
									tip="最多上传5个文件,单个文件不要超过10M,请上传图像格式文件"></sc-upload-multiple>
			</el-form-item>
			<el-form-item label="所属平台" prop="platform">
				<el-cascader v-model="form.platform" :options="platform.list" :props="platform.props"
							 :show-all-levels="false" clearable style="width: 50%;"></el-cascader>
			</el-form-item>
			<el-form-item label="语言类型" prop="lang">
				<el-cascader v-model="form.lang" :options="lang.list" :props="lang.props"
							 :show-all-levels="false" clearable style="width: 50%;"></el-cascader>
			</el-form-item>
		</el-form>
		<template #footer>
			<el-button @click="visible=false">取 消</el-button>
			<el-button type="primary" @click="submit()">保 存</el-button>
		</template>
	</el-dialog>
</template>

<script>
import {defineAsyncComponent} from 'vue';

const scEditor = defineAsyncComponent(() => import('@/components/scEditor'));

export default {
	components: {
		scEditor
	},
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
			form: {},
			//验证规则
			rules: {
				real_name: [
					{required: true, message: '请输入'}
				],
				mobile: [
					{required: true, message: '请输入'}
				],
				content: [
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
					var res = await this.$API.website.message.add.post(this.form);
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
