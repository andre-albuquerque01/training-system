import { UpdatetWorkOutComponent } from '@/components/workOut/update'
import { Metadata } from 'next'

export const metadata: Metadata = {
  title: {
    template: '%s',
    default: 'Alterar workOut',
  },
}

export default function UpdateWorkOut({ params }: { params: { id: string } }) {
  return (
    <div className="flex justify-center items-center mt-4">
      <UpdatetWorkOutComponent id={params.id} />
    </div>
  )
}
