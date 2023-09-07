<template>
	<el-container>
		<!--		<el-aside width="220px">-->
		<!--			<el-tree ref="category" class="menu" node-key="label" :data="category" :default-expanded-keys="['系统日志']"-->
		<!--					 current-node-key="系统日志" :highlight-current="true" :expand-on-click-node="false">-->
		<!--			</el-tree>-->
		<!--		</el-aside>-->
		<el-container>
			<el-main class="nopadding">
				<el-container>
					<el-header>
						<div class="left-panel">

						</div>
						<div class="right-panel">
							<div class="right-panel-search">
								<!--								<el-input v-model="search.name" placeholder="登录名" clearable></el-input>-->
								<!--								<el-input v-model="search.real_name" placeholder="真实姓名" clearable></el-input>-->
								<el-date-picker v-model="search.time" type="datetimerange" range-separator="至"
												start-placeholder="开始日期" end-placeholder="结束日期"
												value-format="YYYY-MM-DD HH:mm:ss"></el-date-picker>
								<el-button type="primary" icon="el-icon-search" @click="upsearch">搜索</el-button>
							</div>
						</div>
					</el-header>
					<!--					<el-header style="height:150px;">-->
					<!--						<scEcharts height="100%" :option="logsChartOption"></scEcharts>-->
					<!--					</el-header>-->
					<el-main class="nopadding">
						<scTable ref="table" :apiObj="apiObj" stripe highlightCurrentRow @row-click="rowClick">
							<!--							<el-table-column label="级别" prop="level" width="60">-->
							<!--								<template #default="scope">-->
							<!--									<el-icon v-if="scope.row.level=='error'" style="color: #F56C6C;">-->
							<!--										<el-icon-circle-close-filled/>-->
							<!--									</el-icon>-->
							<!--									<el-icon v-if="scope.row.level=='warn'" style="color: #E6A23C;">-->
							<!--										<el-icon-warning-filled/>-->
							<!--									</el-icon>-->
							<!--									<el-icon v-if="scope.row.level=='info'" style="color: #409EFF;">-->
							<!--										<el-icon-info-filled/>-->
							<!--									</el-icon>-->
							<!--								</template>-->
							<!--							</el-table-column>-->
							<el-table-column label="ID" prop="id" width="60"></el-table-column>
							<el-table-column label="请求方式" prop="method" width="80"></el-table-column>
							<el-table-column label="请求url带参数" prop="url" show-overflow-tooltip min-width="250"></el-table-column>
							<el-table-column label="请求时间" prop="create_at" width="150"></el-table-column>
							<el-table-column label="请求url不带参数" prop="path" show-overflow-tooltip min-width="300"></el-table-column>
							<el-table-column label="请求IP" prop="request_ip" width="120"></el-table-column>
<!--							<el-table-column label="请求参数" prop="data" width="500"></el-table-column>-->
							<el-table-column label="管理员" prop="admin_name" width="80"></el-table-column>
							<el-table-column label="路由描述" prop="route_desc" width="80"></el-table-column>
							<el-table-column label="路由名称" prop="route_name" width="100"></el-table-column>
						</scTable>
					</el-main>
				</el-container>
			</el-main>
		</el-container>
	</el-container>

	<el-drawer v-model="infoDrawer" title="日志详情" :size="800" destroy-on-close>
		<info ref="info"></info>
	</el-drawer>
</template>

<script>
import info from './info'
import scEcharts from '@/components/scEcharts'

export default {
	name: 'log',
	components: {
		info,
		scEcharts
	},
	data() {
		return {
			infoDrawer: false,
			logsChartOption: {
				color: ['#409eff', '#e6a23c', '#f56c6c'],
				grid: {
					top: '0px',
					left: '10px',
					right: '10px',
					bottom: '0px'
				},
				tooltip: {
					trigger: 'axis'
				},
				xAxis: {
					type: 'category',
					boundaryGap: false,
					data: ['2021-07-01', '2021-07-02', '2021-07-03', '2021-07-04', '2021-07-05', '2021-07-06', '2021-07-07', '2021-07-08', '2021-07-09', '2021-07-10', '2021-07-11', '2021-07-12', '2021-07-13', '2021-07-14', '2021-07-15']
				},
				yAxis: {
					show: false,
					type: 'value'
				},
				series: [{
					data: [120, 200, 150, 80, 70, 110, 130, 120, 200, 150, 80, 70, 110, 130, 70, 110],
					type: 'bar',
					stack: 'log',
					barWidth: '15px'
				},
					{
						data: [15, 26, 7, 12, 13, 9, 21, 15, 26, 7, 12, 13, 9, 21, 12, 3],
						type: 'bar',
						stack: 'log',
						barWidth: '15px'
					},
					{
						data: [0, 0, 0, 120, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
						type: 'bar',
						stack: 'log',
						barWidth: '15px'
					}]
			},
			category: [
				{
					label: '系统日志',
					children: [
						{label: 'debug'},
						{label: 'info'},
						{label: 'warn'},
						{label: 'error'},
						{label: 'fatal'}
					]
				},
				{
					label: '应用日志',
					children: [
						{label: 'selfHelp'},
						{label: 'WechatApp'}
					]
				}
			],
			date: [],
			apiObj: this.$API.system.adminLog.list,
			search: {
				time: ""
			}
		}
	},
	methods: {
		//搜索
		upsearch() {
			console.log(this.search)
			this.$refs.table.upData(this.search)
		},
		rowClick(row) {
			this.infoDrawer = true
			this.$nextTick(() => {
				this.$refs.info.setData(row)
			})
		}
	}
}
</script>

<style>
</style>
