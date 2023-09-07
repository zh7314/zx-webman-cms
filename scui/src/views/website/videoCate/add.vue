<template>
	<el-dialog :title="title" v-model="visible" :width="500" destroy-on-close @closed="$emit('closed')">
		<el-form :model="form" :rules="rules" ref="dialogForm" label-width="100px">
			<el-form-item label="上级" prop="parent_id">
				<el-cascader v-model="form.parent_id" :options="options" :props="props"
							 :show-all-levels="false" clearable style="width: 100%;"></el-cascader>
			</el-form-item>
			<el-form-item label="分类名称" prop="name">
				<el-input v-model="form.name" placeholder="请输入部门名称" clearable></el-input>
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
				<el-input-number v-model="form.sort" controls-position="right" :min="1"
								 :max="255" style="width: 30%;"></el-input-number>
			</el-form-item>
		</el-form>
		<template #footer>
			<el-button @click="visible=false">取 消</el-button>
			<el-button type="primary" :loading="isSaveing" @click="submit()">保 存</el-button>
		</template>
	</el-dialog>
</template>

<script>
export default {
	emits: ['success', 'closed'],
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
			isSaveing: false,
			//表单数据
			form: {
				parent_id: "",
				name: "",
				sort: 255
			},
			//验证规则
			rules: {
				sort: [
					{required: true, message: '请输入', trigger: 'change'}
				],
				name: [
					{required: true, message: '请输入'}
				],
				platform: [
					{required: true, message: '请输入'}
				],
				lang: [
					{required: true, message: '请输入'}
				]
			},
			topOptions: {
				id: 0,
				value: 0,
				parent_id: 0,
				label: "顶级分类",
				name: "顶级分类",
				children: []
			},
			//所需数据选项
			options: [],
			props: {
				value: "id",
				emitPath: false,
				checkStrictly: true,
				label: "name"
			}
		}
	},
	mounted() {
		this.getVideoCate()
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
		//加载树数据
		async getVideoCate() {
			var res = await this.$API.website.videoCate.getTree.get();
			this.options = res.data;
			this.options.unshift(this.topOptions)
		},
		//表单提交方法
		submit() {
			this.$refs.dialogForm.validate(async (valid) => {
				if (valid) {
					this.isSaveing = true;
					var res = await this.$API.website.videoCate.add.post(this.form);
					this.isSaveing = false;
					if (res.code == 200) {
						this.$emit('success', this.form)
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
