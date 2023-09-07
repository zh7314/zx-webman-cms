<template>
	<el-dialog :title=title v-model="visible" :width="1000" destroy-on-close>
		<el-form :model="form" :rules="rules" ref="dialogForm" label-width="100px"
				 label-position="left">
			<el-form-item label="分类" prop="video_cate_id">
				<el-cascader v-model="form.video_cate_id" :options="options" :props="props"
							 :show-all-levels="false" clearable style="width: 100%;"></el-cascader>
			</el-form-item>
			<el-form-item label="标题" prop="name">
				<el-input v-model="form.name" clearable></el-input>
			</el-form-item>
			<el-form-item label="图片" prop="pic">
				<sc-upload v-model="form.pic" title="上传头像"></sc-upload>
			</el-form-item>
			<el-form-item label="视频文件" prop="file">
				<sc-upload-file v-model="form.file" :limit="1" :data="{otherData:'demo'}"
								tip="最多上传1个文件,单个文件不要超过10M,请上传MP4/FLV格式文件">
					<el-button type="primary" icon="el-icon-upload">上传视频MP4文件</el-button>
				</sc-upload-file>
			</el-form-item>
			<el-form-item label="介绍" prop="introduce">
				<sc-editor v-model="form.introduce" placeholder="请输入" :height="400"></sc-editor>
			</el-form-item>
			<el-form-item label="是否显示" prop="is_show">
				<el-radio-group v-model="form.is_show" class="ml-4">
					<el-radio :label="10" size="large">是</el-radio>
					<el-radio :label="20" size="large">否</el-radio>
				</el-radio-group>
			</el-form-item>
			<el-form-item label="是否本地" prop="is_local">
				<el-radio-group v-model="form.is_local" class="ml-4">
					<el-radio :label="10" size="large">本地</el-radio>
					<el-radio :label="20" size="large">外部</el-radio>
				</el-radio-group>
			</el-form-item>
			<el-form-item label="跳转链接" prop="url">
				<el-input v-model="form.url" clearable></el-input>
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
			form: {
				name: "",
				sort: 255,
				is_local: 10,
				is_show: 10
			},
			//验证规则
			rules: {
				video_cate_id: [
					{required: true, message: '请输入'}
				],
				name: [
					{required: true, message: '请输入'}
				],
				pic: [
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
		this.getVideoCate()
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
			// this.options.unshift(this.topOptions)
		},
		//表单提交方法
		submit() {
			this.$refs.dialogForm.validate(async (valid) => {
				if (valid) {
					var res = await this.$API.website.video.add.post(this.form);
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
