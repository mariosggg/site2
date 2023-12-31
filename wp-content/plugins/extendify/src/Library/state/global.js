import { create } from 'zustand';
import { devtools } from 'zustand/middleware';

const state = (set) => ({
	open: false,
	setOpen: (open) => set({ open }),
});

export const useGlobalsStore = create(
	devtools(state, { name: 'Extendify Library Globals' }),
	state,
);
