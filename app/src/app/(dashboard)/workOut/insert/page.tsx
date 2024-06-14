import { InsertWorkOutComponent } from '@/components/workOut/insert/insert'
import { Metadata } from 'next'

export const metadata: Metadata = {
  title: {
    template: '%s',
    default: 'Insert workOut',
  },
}

export default function InsertWorkOut() {
  return (
    <div className="flex justify-center items-center h-screen">
      <InsertWorkOutComponent />
    </div>
  )
}
