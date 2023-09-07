<template>
	<el-dialog :title=title v-model="visible" :width="500" destroy-on-close>
		<el-form :model="form" :rules="rules" ref="dialogForm" label-width="100px"
				 label-position="left">
			<el-form-item label="分类" prop="banner_cate_id">
				<el-cascader v-model="form.banner_cate_id" :options="options" :props="props"
							 :show-all-levels="false" clearable style="width: 100%;"></el-cascader>
			</el-form-item>
			<el-form-item label="标题" prop="name">
				<el-input v-model="form.name" clearable></el-input>
			</el-form-item>
			<el-form-item label="banner图片" prop="pic_path">
				<sc-upload v-model="form.pic_path" title="上传头像"></sc-upload>
			</el-form-item>
			<el-form-item label="视频文件" prop="video_path">
				<sc-upload-file v-model="form.video_path" :limit="1" :data="{otherData:'demo'}"
								tip="最多上传1个文件,单个文件不要超过10M,请上传MP4/FLV格式文件">
					<el-button type="primary" icon="el-icon-upload">上传视频MP4文件</el-button>
				</sc-upload-file>
			</el-form-item>
			<el-form-item label="跳转链接" prop="url">
				<el-input v-model="form.url" clearable></el-input>
			</el-form-item>
			<el-form-item label="显示开始时间" prop="start_time">
				<el-date-picker v-model="form.start_time" type="datetime" placeholder="请选择"
								value-format="YYYY-MM-DD HH:mm:ss"/>
			</el-form-item>
			<el-form-item label="显示结束时间" prop="end_time">
				<el-date-picker v-model="form.end_time" type="datetime" placeholder="请选择"
								value-format="YYYY-MM-DD HH:mm:ss"/>
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
								 :min="0" style="width: 20%;"></el-input-number>
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
			title: '编辑',
			visible: false,
			form: {},
			//验证规则
			rules: {
				name: [
					{required: true, message: '请输入'}
				],
				pic_path: [
					{required: true, message: '请输入'}
				],
				platform: [
					{required: true, message: '请输入'}
				],
				lang: [
					{required: true, message: '请输入'}
				]
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
		this.getLang()
		this.getPlatform()
		this.getBannerCate()
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
		async getBannerCate() {
			var res = await this.$API.website.bannerCate.getTree.get();
			this.options = res.data;
		},
		//表单提交方法
		submit() {
			this.$refs.dialogForm.validate(async (valid) => {
				if (valid) {
					var res = await this.$API.website.banner.save.post(this.form);
					if (res.code == 200) {
						this.$emit('success', this.form)
						this.visible = false;
						this.$message.success("操作成功")
					} else {
						this.$alert(res.msg, "提示", {type: 'error'})
					}
				}
			})
		},
		//表单注入数据
		setData(data) {
			//可以和上面一样单个注入，也可以像下面一样直接合并进去
			Object.assign(this.form, data)
		}
	}
}
</script>

<style>
</style>
