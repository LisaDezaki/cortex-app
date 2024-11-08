<script>
	// import { Link } from "@inertiajs/svelte";
	import { Dialog } from "bits-ui";
	import { Trash2, X } from "lucide-svelte";
	import { fade } from "svelte/transition";
	
	export let click;

	function confirm(e) {
		click(e);
	}
</script>

<!-- <AlertDialog.Root>

  <AlertDialog.Trigger class="inline-flex justify-center items-center gap-2 px-3 py-2 pr-4 rounded bg-red-500 text-white">
		<Trash2 size={20} strokeWidth={1.25} />Delete
  </AlertDialog.Trigger>

  <AlertDialog.Portal>
    <AlertDialog.Overlay class="fixed inset-0 z-50 bg-black/80" transitionConfig={{ duration: 150 }} />
    <AlertDialog.Content class="bg-white fixed left-[50%] top-[50%] z-50 grid w-full max-w-[94%] translate-x-[-50%] translate-y-[-50%] gap-2 rounded-xl border bg-background p-4 shadow-popover outline-none sm:max-w-lg md:w-full"
    >
      <div class="flex flex-col gap-4 pb-6">
        <AlertDialog.Title class="text-lg font-semibold tracking-tight"
          >Confirm deletion</AlertDialog.Title
        >
        <AlertDialog.Description class="text-sm text-foreground-alt">
          This cannot be undone.
        </AlertDialog.Description>
      </div>
      <div class="flex w-full items-center justify-end gap-2">
        <AlertDialog.Cancel class="inline-flex justify-center items-center px-3 py-2 rounded bg-black/35 text-white"
          >Cancel</AlertDialog.Cancel
        >
        <AlertDialog.Action class="inline-flex justify-center items-center px-3 py-2 rounded bg-red-500 text-white"          
          on:click={click}>Continue</AlertDialog.Action
        >
      </div>
    </AlertDialog.Content>
  </AlertDialog.Portal>
</AlertDialog.Root> -->

<Dialog.Root>
  <Dialog.Trigger class="inline-flex justify-center items-center gap-2 px-3 py-2 pr-4 rounded bg-red-500 text-white">
		<Trash2 size={20} strokeWidth={1.25} />Delete
  </Dialog.Trigger>
  <Dialog.Portal>
    <Dialog.Overlay
      transition={fade}
      transitionConfig={{ duration: 150 }}
      class="fixed inset-0 z-50 bg-black/80"
    />
    <Dialog.Content
      class="fixed left-[50%] top-[50%] translate-x-[-50%] translate-y-[-50%] z-50
						  w-full max-w-[94%] sm:max-w-[490px] md:w-full p-5
							border rounded-xl shadow-popover outline-none 
						bg-white"
    >
      <Dialog.Title
        class="flex w-full items-center justify-start text-lg font-semibold tracking-tight mb-4"
        >Delete?</Dialog.Title
      >
      <Dialog.Description class="text-foreground-alt">
        Are you sure you want to delete? This cannot be undone.
      </Dialog.Description>

      <div class="flex w-full justify-end gap-2 mt-4">
				<Dialog.Close
          class="inline-flex items-center justify-center h-input gap-2 px-3 py-2
								bg-slate-200 rounded text-slate-800 focus-visible:outline-none
								focus-visible:ring-2 focus-visible:ring-dark focus-visible:ring-offset-2 focus-visible:ring-offset-background active:scale-98"
        >
          Cancel
        </Dialog.Close>
        <Dialog.Close
          class="inline-flex items-center justify-center h-input gap-2 px-3 py-2
								rounded bg-red-500 text-white
								focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-dark focus-visible:ring-offset-2 focus-visible:ring-offset-background active:scale-98"
        	on:click={confirm}>
          Delete
        </Dialog.Close>
      </div>
      <Dialog.Close
        class="absolute right-5 top-5 rounded-md focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-foreground focus-visible:ring-offset-2 focus-visible:ring-offset-background active:scale-98"
      >
        <div>
          <X class="size-5 text-foreground" />
          <span class="sr-only">Close</span>
        </div>
      </Dialog.Close>
    </Dialog.Content>
  </Dialog.Portal>
</Dialog.Root>