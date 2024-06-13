'use serve'

export interface WorkOutInterface {
  idWorkOut: string
  name: string
  description: string
  image: string | null
  video: string | null
  muscle: string | null
  equipment: string | null
  difficulty: string | null
  duration: string | null
  calories: string | null
  weight: string | null
  repetition: string | null
  created_at: string
  updated_at: string
  deleted_at: string | null
}
