<template>
  <div v-if="isOpen">
  <confirmDialog @action="deleteSelectedReports"></confirmDialog>
  </div>
  <div class="p-6 bg-white rounded shadow text-sm h-full overflow-y-auto">
    <div class="flex items-center justify-between mb-4">
      <h2 class="text-lg font-semibold">Reports ({{ reports.length }})</h2>
      <div class="flex items-center gap-4">
        <div class="flex justify-center items-center border-[1.5px] shadow px-2 rounded border-gray-200">
            <span>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 1 0 0 11 5.5 5.5 0 0 0 0-11ZM2 9a7 7 0 1 1 12.452 4.391l3.328 3.329a.75.75 0 1 1-1.06 1.06l-3.329-3.328A7 7 0 0 1 2 9Z" clip-rule="evenodd" />
                </svg>
            </span>
            <div>
            <input
                    type="text"
                    placeholder="Search"
                    class="px-4 py-2 rounded w-64 focus:outline-none focus:ring-0 border-none"
                />
            </div>
        </div>
        <button class="text-blue-600 cursor-pointer"
        @click="openCreateDialog"
        >Create</button>
        <button class="text-blue-600 cursor-pointer" 
        @click="toggleDialog"
        >Delete</button>
        <button class="text-gray-500 hover:text-blue-600 cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
           <path stroke-linecap="round" stroke-linejoin="round" d="M3 7.5 7.5 3m0 0L12 7.5M7.5 3v13.5m13.5 0L16.5 21m0 0L12 16.5m4.5 4.5V7.5" />
          </svg>
        </button>
        <button class="text-gray-500 hover:text-blue-600 cursor-pointer">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M6.72 13.829c-.24.03-.48.062-.72.096m.72-.096a42.415 42.415 0 0 1 10.56 0m-10.56 0L6.34 18m10.94-4.171c.24.03.48.062.72.096m-.72-.096L17.66 18m0 0 .229 2.523a1.125 1.125 0 0 1-1.12 1.227H7.231c-.662 0-1.18-.568-1.12-1.227L6.34 18m11.318 0h1.091A2.25 2.25 0 0 0 21 15.75V9.456c0-1.081-.768-2.015-1.837-2.175a48.055 48.055 0 0 0-1.913-.247M6.34 18H5.25A2.25 2.25 0 0 1 3 15.75V9.456c0-1.081.768-2.015 1.837-2.175a48.041 48.041 0 0 1 1.913-.247m10.5 0a48.536 48.536 0 0 0-10.5 0m10.5 0V3.375c0-.621-.504-1.125-1.125-1.125h-8.25c-.621 0-1.125.504-1.125 1.125v3.659M18 10.5h.008v.008H18V10.5Zm-3 0h.008v.008H15V10.5Z" />
          </svg>
        </button>
      </div>
    </div>

    <div class="overflow-x-auto ">
      <table class="min-w-full text-left border-t border-b border-gray-200">
        <thead class="bg-gray-100 text-gray-700">
          <tr>
            <th class="p-2"><input type="checkbox" v-model="selectAll" /></th>
            <th class="p-2">Report ID.</th>
            <th class="p-2">Reporter</th>
            <th class="p-2">Problem</th>
            <th class="p-2">Article ID</th>
            <th class="p-2">Issued Date</th>
            <th class="p-2"></th>
          </tr>
        </thead>
        <tbody>
          <tr
            v-for="(report, index) in reports"
            :key="index"
            class="hover:bg-gray-100 border-t border-gray-200"
            
          >
            <td class="p-2"><input 
                type="checkbox" 
                v-model="report.selected"
                @change="checkSelectAll"
                /></td>
            <td class="p-2 text-blue-600 cursor-pointer">
              {{ report.id }}
            </td>
            <td class="p-2">{{ report.reporter }}</td>
            <td class="p-2">{{ report.problem }}</td>
            <td class="p-2">{{ report.articleId }}</td>
            <td class="p-2">{{ report.issued }}</td>
            <td class="p-2" @click="openEditDialog(report)">
              <svg
                xmlns="http://www.w3.org/2000/svg"
                class="w-4 h-4 text-gray-500 hover:text-blue-600 cursor-pointer"
                fill="none"
                viewBox="0 0 24 24"
                stroke="currentColor"
                stroke-width="2"
              >
                <path
                  stroke-linecap="round"
                  stroke-linejoin="round"
                  d="M9 5l7 7-7 7"
                />
              </svg>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>

  <!-- update -->
  <EditReportDialog
  :show="showEdit"
  :report="selectedReport"
  :reporter-options="reporterOptions"
  @close="showEdit = false"
  @save="updateReport"
  />
   <!-- Add Create Report Dialog -->
  <CreateReportDialog
    :show="showCreate"
    :reporter-options="reporterOptions"
    @close="showCreate = false"
    @save="createReport"
  />
</template>

  <script lang="ts" setup>
  import { ref, watch, onMounted, computed } from 'vue'
  import axios from 'axios'
  import confirmDialog from '../__shared__/dialog/confirm-dialog.vue'
  import EditReportDialog from '../__shared__/dialog/EditReportDialog.vue'
  import CreateReportDialog from '../__shared__/dialog/CreateReportDialog.vue' 
  
  interface Report {
    id: string
    reporter_id: number
    reporter: string
    problem: string
    articleId: string
    issued: string
    selected: boolean
  }

  const showCreate = ref(false)  // dialog state for create

  // Open create dialog handler
  const openCreateDialog = () => {
    showCreate.value = true;
  }
  const isOpen = ref(false);
  const selectAll = ref(false)
  const reports = ref<Report[]>([])
  const reporterOptions = computed(() => {
    const unique = new Map()
    reports.value.forEach(r => {
      if (r.reporter_id && r.reporter) {
        unique.set(r.reporter_id, r.reporter)
      }
    })
    return Array.from(unique.entries()).map(([id, name]) => ({ id, name }))
  })


  const toggleDialog = () => {
    const selectedReports = reports.value.filter(report => report.selected);
    if(selectedReports.length > 0){
      isOpen.value = !isOpen.value;
    }
  };

  async function fetchReports(){
    
    try {
      const jwtToken = localStorage.getItem('auth_token');
      if (!jwtToken) return;

      const response = await axios.get('http://localhost:8000/api/admin/report', {
        headers: {
          Authorization: `Bearer ${jwtToken}`
        }
      })

      // Map your API response to your Report interface structure
      reports.value = response.data.map((r: any) => ({
        id: r.report_id,
        reporter_id: r.reporter_id,
        reporter: r.reporter,
        problem: r.reason,
        articleId: r.article_id,
        issued: r.issued_date,
        selected: false,
      })).sort((a, b) => {
        // Assuming id is numeric string; convert to number for sorting
        return Number(a.id) - Number(b.id);
      })

      // Update selectAll if needed
      checkSelectAll()

    } catch (error) {
      console.error('Failed to load report:', error)
    }
  };

  onMounted(fetchReports);

  // Watch "selectAll" and update all reports
  watch(selectAll, (val) => {
    reports.value.forEach((report) => {
      report.selected = val
    })
  })

  // Update "selectAll" when any individual checkbox is changed
  function checkSelectAll() {
    selectAll.value = reports.value.length > 0 && reports.value.every((report) => report.selected)
  }

  async function deleteSelectedReports() {
    const selectedReports = reports.value.filter(report => report.selected);

    if (selectedReports.length === 0) {
      alert('No reports selected.');
      return;
    }

    try {
      const jwtToken = localStorage.getItem('auth_token');
      if (!jwtToken) return;

      const idsToDelete = selectedReports.map(r => r.id);

      await axios.delete('http://localhost:8000/api/admin/report', {
        headers: {
          Authorization: `Bearer ${jwtToken}`
        },
        data: {
          reportIds: idsToDelete
        }
      });

      // Remove deleted reports from local state
      reports.value = reports.value.filter(report => !report.selected);
      selectAll.value = false;
    } catch (error) {
      console.error('Failed to delete reports:', error);
      alert('Failed to delete reports.');
    }
}



const showEdit = ref(false)
const selectedReport = ref(null)

function openEditDialog(report) {
  selectedReport.value = report
  showEdit.value = true
}

async function updateReport(updated) {
  const jwtToken = localStorage.getItem('auth_token');
  if (!jwtToken) return;

  try {
     const response = await axios.post(
     `http://localhost:8000/api/admin/report/${updated.id}`, 
     {
        reporter_id: updated.reporter_id, 
        problem: updated.problem,
        article_id: updated.article_id
     },
     {
      headers: {
        Authorization: `Bearer ${jwtToken}`
      }
    })
    console.log(response)
    // Reload reports after update
    await fetchReports();
  } catch (error) {
    console.error('Failed to update report:', error);
  }
}

// Handle create save
async function createReport(newReport) {
  const jwtToken = localStorage.getItem('auth_token');
  console.log("hey")
  if (!jwtToken) return;

  try {
    const response = await axios.post(
      'http://localhost:8000/api/admin/report',
      {
        reporter_id: newReport.reporter_id,
        problem: newReport.problem,
        article_id: newReport.article_id
      },
      {
        headers: {
          Authorization: `Bearer ${jwtToken}`
        }
      }
    );

    // console.log('Created:', response.data);
    // Close dialog and refresh report list
    showCreate.value = false;
    await fetchReports();

  } catch (error) {
    console.error('Failed to create report:', error);
  }
}
</script>

